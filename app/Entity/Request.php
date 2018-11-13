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
        $this->offset = 0;
        $this->limit = 100;
        $this->method = $method;
        $this->params = $params;
        $this->updateParams();
    }

    /**
     * @return string
     */
    public function getParams(): string
    {
        return $this->method . '?' . http_build_query($this->params);
    }

    /**
     * @param int $count
     * @return bool
     */
    public function addOffset(int $count): bool
    {
        if ($this->checkPaginate($count)) {
            $this->offset += $this->limit;
            $this->updateParams();
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
        return ($this->limit + $this->offset) < $count;
    }

    protected function updateParams(): void
    {
        $this->params['offset'] = $this->offset;
        $this->params['limit'] = $this->limit;
    }
}
