<?php

namespace App\Providers\remote;

class Response
{
    /** @var array */
    private $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function getBody(): array
    {
        return $this->data;
    }
}
