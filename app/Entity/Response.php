<?php

namespace App\Entity;

/**
 * Class Response
 * @package App\Entity
 */
class Response
{
    /** @var array $data */
    protected $data;

    /**
     * Response constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @return array
     */
    public function getBody(): array
    {
        return $this->data;
    }

}
