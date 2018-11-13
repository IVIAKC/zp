<?php

namespace App\Entity;

/**
 * Class Request
 * @package App\Entity
 */
class Request
{
    /** @var array $params */
    protected $params;

    /** @var string $method */
    protected $method;

    /**
     * Request constructor.
     * @param $method
     * @param $params
     */
    public function __construct($method, $params)
    {
        $this->method = $method;
        $this->params = $params;
    }

    /**
     * @return string
     */
    public function getParams()
    {
        return $this->method . '?' . http_build_query($this->params);
    }
}
