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

    /** @var int $limit */
    protected $limit;

    /** @var int $offset */
    protected $offset;

    /**
     * Request constructor.
     * @param $method
     * @param $params
     */
    public function __construct($method, $params)
    {
        $this->method = $method;
        $this->params = http_build_query($params);
        $this->offset = 0;
        $this->limit = 100;
    }

    /**
     * @return string
     */
    public function getParams(): string
    {
        return $this->method . '?' . $this->params . "&offset=$this->offset&limit=$this->limit";
    }

    /**
     * @param int $count
     * @return bool
     */
    public function addOffset(int $count): bool
    {
        if ($this->checkPaginate($count)) {
            $this->offset += 1;
            return true;
        }
        return false;
    }

    /**
     * @param int $count
     * @return bool
     */
    public function checkPaginate(int $count): bool
    {
        return ($this->limit * $this->offset + $this->limit) < $count;
    }
}
