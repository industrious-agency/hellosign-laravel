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
    private $client;

    /**
     * @var HelloSign\Request
     */
    private $request;

    /**
     * @var array
     */
    private $config;

    /**
     * @param HelloSignLaravel\Client $client
     * @param HelloSign\Request $request
     * @param array $config
     */
    public function __construct(Client $client, HelloSign\SignatureRequest $request, array $config)
    {
        $this->client = $client;
        $this->request = $request;
        $this->config = $config;
    }

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
