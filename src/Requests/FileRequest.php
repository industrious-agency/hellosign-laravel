<?php

namespace Industrious\HelloSignLaravel\Requests;

class FileRequest
{
    public function __construct()
    {
        $this->signature_request_id = null;
        $this->file_type = 'pdf';
        $this->get_url = false;
    }

    public function setSignatureRequestId(string $id)
    {
        $this->signature_request_id = $id;

        return $this;
    }

    public function setFileType(string $type)
    {
        $this->file_type = $type;

        return $this;
    }

    public function setGetUrl(bool $bool)
    {
        $this->get_url = $bool;

        return $this;
    }
}
