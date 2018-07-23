<?php

namespace Industrious\HelloSignLaravel\Classes;

use Industrious\HelloSignLaravel\Client;
use Industrious\HelloSignLaravel\Requests\SignatureRequest;
use Exception;

class StatusRequest
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
     * @param SignatureRequest $request
     * @param array $config
     */
    public function __construct(Client $client, SignatureRequest $request, array $config)
    {
        $this->client = $client;
        $this->request = $request;
        $this->config = $config;
    }

    /**
     * Send a signature request.
     *
     * @return mixed
     */
    public function send()
    {
        try {
            return $this->client->getSignatureRequest($this->request->signature_request_id);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * @param string $name
     * @param array  $arguments
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
