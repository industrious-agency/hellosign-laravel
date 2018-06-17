<?php

namespace Industrious\HelloSignLaravel\Classes;

use Exception;

class TemplateSignatureRequest extends SignatureRequest
{
    /**
     * Send a templated signature request.
     *
     * @return mixed
     */
    public function send()
    {
        try {
            return $this->client->sendTemplateSignatureRequest($this->request);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
