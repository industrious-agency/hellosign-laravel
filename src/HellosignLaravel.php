<?php

namespace Industrious\HellosignLaravel;

class HellosignLaravel
{
    public function __construct(Client $client)
    {
        $this->client = $client;
    }
}
