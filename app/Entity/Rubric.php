<?php

namespace App\Entity;

/**
 * Class Rubric
 * @package App\Entity
 */
class Rubric
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
}
