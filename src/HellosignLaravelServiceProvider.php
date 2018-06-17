<?php

namespace Industrious\HelloSignLaravel;

use HelloSign;
use Illuminate\Support\ServiceProvider;

class HellosignLaravelServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {

            // Publishing the configuration file.
            $this->publishes([
                __DIR__.'/../config/hellosign.php' => config_path('hellosign.php'),
            ], 'laravel-hellosign');

            // Registering package commands.
            // $this->commands([]);
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/hellosign.php', 'hellosign');

        // Register the Hellosign\Client Service
        $this->app->singleton(Client::class, function ($app) {
            $config = $app['config']['hellosign'];
            $params = $this->getAuthenticationParams($config['authentication']);

            $client = new HelloSign\Client(...$params);

            return new Client($client, $config);
        });

        // Register the Hellosign\SignatureRequest Service
        $this->app->singleton(Classes\SignatureRequest::class, function ($app) {
            $client = $app->make(Client::class);
            $request = new HelloSign\SignatureRequest;
            $config = $app['config']['hellosign'];

            if (array_get($config, 'test_mode')) {
                $request->enableTestMode();
            }

            return new Classes\SignatureRequest($client, $request, $config);
        });
    }

    /**
     * @param  array  $config
     * @return array
     */
    private function getAuthenticationParams(array $config): array
    {
        $params = null;

        switch ($config['method']) {
            case 'key':
                $params = array_get($config['params'], 'api_key');
                break;

            case 'email':
                $params = array_only($config['params'], ['email', 'password']);
                break;

            case 'oauth':
                $token = array_get($config['params'], 'oauth_token');
                $params = new HelloSign\OAuthToken($token);
                break;
        }

        if (! $params) {
            throw new \Exception('Invalid authentication method specified for hellosign.');
        }

        return array_values((array) $params);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['hellosign-laravel'];
    }
}
