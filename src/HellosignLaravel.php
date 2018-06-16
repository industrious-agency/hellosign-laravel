<?php

namespace Industrious\HellosignLaravel;

use HelloSign\Client;

class HellosignLaravel
{
    /**
     * @var Hellosign\Client
     */
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }
}
