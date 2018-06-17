<?php

namespace Industrious\HelloSignLaravel\Classes;

use HelloSign;

class SignatureRequest
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
     */
    public function __construct(HelloSign\Client $client, array $config)
    {
        $this->client = $client;
        $this->test_mode = array_get($config, 'test_mode');
    }

    public function send()
    {
        // $request = new HelloSign\SignatureRequest;

        // $params = [
        //     'title' => 'setTitle',
        //     'subject' => 'setSubject',
        //     'message' => 'setMessage'
        // ];

        // foreach ($params as $key => $method) {
        //     if ($value = array_get($data, $key)) {
        //         $request->{$method}($value);
        //     }
        // }

        if ($this->test_mode) {
            $request->enableTestMode();
        }

        // foreach ((array) $send_to as $signer)
        // {
        //     $signer = (array) $signer;

        //     $email = $signer['email'] ?? $signer[0];
        //     $name = $signer['name'] ?? array_get($signer, '0', $email);

        //     $request->addSigner($email, $name);
        // }

        // // $request->addCC('lawyer@example.com');
        // $request->addFile('nda.pdf');

        try {
            return $this->client->sendSignatureRequest($request);
        } catch (\Exception $e) {
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
            return $this->{$name}($arguments);
        }

        return $this->client->{$name}($arguments);
    }
}
