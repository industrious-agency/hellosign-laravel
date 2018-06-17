<?php

namespace Industrious\HelloSignLaravel;

use HelloSign;

class Client
{
    /**
     * @var HelloSign\Client
     */
    private $client;

    /**
     * @var array
     */
    private $config;

    /**
     * @param HelloSign\Client $client
     * @param array $config
     */
    public function __construct(HelloSign\Client $client, array $config)
    {
        $this->client = $client;
        $this->config = $config;
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

        return $this->client->{$name}(...$arguments);
    }
}
