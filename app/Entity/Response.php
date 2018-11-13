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
     * @param array $input
     */
    public function __construct(array $input)
    {
        $this->metadata = array_shift($input);
        $this->data = array_shift($input);
    }

    /**
     * @return bool
     */
    public function isError(): bool
    {
        return isset($this->metadata['errors']);
    }
}
