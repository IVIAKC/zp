<?php

namespace App\Providers\remote;

class Request
{
    /** @var array */
    private $params;

    /** @var string $method */
    private $method;

    /** @var int $limit */
    private $limit = 100;

    /** @var int $offset */
    private $offset = 0;

    public function __construct(string $method, array $params = [])
    {
        $this->method = $method;
        $this->params = $params;
        $this->setPagination();
    }

    public function getParams(): string
    {
        return sprintf('%s?%s', $this->method, http_build_query($this->params));
    }

    public function addOffset(int $count): bool
    {
        if ($isCompletePaginate = $this->isCompletePaginate($count)) {
            $this->offset += $this->limit;
            $this->setPagination();
        }

        return $isCompletePaginate;
    }

    public function isCompletePaginate(int $count): bool
    {
        return ($this->limit + $this->offset) < $count;
    }

    protected function setPagination(): void
    {
        $this->params['offset'] = $this->offset;
        $this->params['limit'] = $this->limit;
    }
}
