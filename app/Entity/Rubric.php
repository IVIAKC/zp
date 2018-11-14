<?php

namespace App\Entity;

/**
 * Class Rubric
 * @package App\Entity
 */
class Rubric implements \App\Interfaces\TableRow
{
    /** @var string $name */
    protected $name;

    /** @var string $count */
    protected $count;

    /**
     * Vacancy constructor.
     * @param string $name
     */
    public function __construct(string $name)
    {
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


    public function getCount(): int
    {
        return $this->count;
    }

    public function increaseCount(): void
    {
        $this->count += 1;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->name;
    }
}