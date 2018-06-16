<?php

namespace Industrious\HellosignLaravel;

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
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'industrious');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'industrious');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {

            // Publishing the configuration file.
            $this->publishes([
                __DIR__.'/../config/hellosign.php' => config_path('hellosign.php'),
            ], 'hellosign.config');

            // Publishing the views.
            // $this->publishes([
            //     __DIR__.'/../resources/views' => base_path('resources/views/vendor/industrious'),
            // ], 'hellosign.views');

            // Publishing assets.
            // $this->publishes([
            //     __DIR__.'/../resources/assets' => public_path('vendor/industrious'),
            // ], 'hellosign.views');

            // Publishing the translation files.
            // $this->publishes([
            //     __DIR__.'/../resources/lang' => resource_path('lang/vendor/industrious'),
            // ], 'hellosign.views');

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

        // Register the service the package provides.
        $this->app->singleton(HellosignLaravel::class, function ($app) {
            $api_key = '';

            $this->client = new HelloSign\Client($api_key);

            return new HellosignLaravel($client);
        });
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
