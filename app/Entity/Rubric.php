<?php

namespace App\Entity;


class Rubric
{
    /** @var string $name */
    protected $name;

    /** @var string $count */
    protected $count;

    /** @var int $id */
    protected $id;

    /**
     * Vacancy constructor.
     * @param string $name
     * @param int $id
     */
    public function __construct(?string $name, int $id)
    {
        $this->id = $id;
        $this->name = $name;
        $this->count = 0;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    public function getCount()
    {
        return $this->count;
    }

    public function appendCount()
    {
        $this->count += 1;
    }
}