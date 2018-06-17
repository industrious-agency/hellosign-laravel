<?php

namespace Industrious\HelloSignLaravel\Classes;

use Exception;
use HelloSign;
use Industrious\HelloSignLaravel\Client;

class SignatureRequest
{
    /**
     * @var HelloSign\Client
     */
    protected $client;

    /**
     * @var HelloSign\Request
     */
    protected $request;

    /**
     * @var array
     */
    protected $config;

    /**
     * @param HelloSignLaravel\Client $client
     * @param HelloSign\AbstractSignatureRequest $request
     * @param array $config
     */
    public function __construct(Client $client, HelloSign\AbstractSignatureRequest $request, array $config)
    {
        $this->client = $client;
        $this->request = $request;
        $this->config = $config;

        if (array_get($this->config, 'test_mode')) {
            $this->request->enableTestMode();
        }
    }

    /**
     * Send a signature request.
     *
     * @return mixed
     */
    public function send()
    {
        try {
            return $this->client->sendSignatureRequest($this->request);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * @param  string $name
     * @param  array  $arguments
     */
    public function __call(string $name, array $arguments)
    {
        if (method_exists($this, $name)) {
            return $this->{$name}(...$arguments);
        }

        $this->request->{$name}(...$arguments);

        return $this;
    }
}
