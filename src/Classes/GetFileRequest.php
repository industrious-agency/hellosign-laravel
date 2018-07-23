<?php

namespace Industrious\HelloSignLaravel\Classes;

use Industrious\HelloSignLaravel\Client;
use Industrious\HelloSignLaravel\Requests\FileRequest;
use Exception;

class GetFileRequest
{
    /**
     * @var HelloSign\Client
     */
    protected $client;

    /**
     * @var array
     */
    protected $config;

    /**
     * @var array
     */
    protected $request;

    /**
     * @param HelloSignLaravel\Client $client
     * @param FileRequest $request
     * @param array $config
     */
    public function __construct(Client $client, FileRequest $request, array $config)
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
    public function download()
    {
        try {
            return $this->client->getFiles(
                $this->request->signature_request_id,
                $this->request->file_type,
                $this->request->get_url
            );
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * @param string $name
     * @param array $arguments
     * @return GetFileRequest
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