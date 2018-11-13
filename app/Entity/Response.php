<?php

namespace App\Entity;


class Response
{
    /** @var array $metadata */
    protected $metadata;

    /** @var array $data */
    protected $data;

    /**
     * Response constructor.
     * @param array $data
     * @param array $metadata
     */
    public function __construct(array $data, array $metadata)
    {
        $this->data = $data;
        $this->metadata = $metadata;
    }

    public function getBody()
    {
        return $this->data;
    }

    public function getMeta()
    {
        return $this->metadata;
    }
}
