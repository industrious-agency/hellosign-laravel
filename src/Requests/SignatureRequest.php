<?php

namespace Industrious\HelloSignLaravel\Requests;

Class SignatureRequest {

    public function __construct()
    {
        $this->signature_request_id = null;
    }

    public function setSignatureRequestId(string $id)
    {
        $this->signature_request_id = $id;

        return $this;
    }
}