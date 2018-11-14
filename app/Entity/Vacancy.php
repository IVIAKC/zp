<?php

namespace App\Entity;

/**
 * Class Vacancy
 * @package App\Entity
 */
class Vacancy
{
    /** @var string $name */
    protected $name;

    /** @var array|null $rubrics */
    protected $rubrics;

    /** @var null|string */
    protected $position;

    /**
     * Vacancy constructor.
     * @param array|null $rubrics
     * @param null|array $position
     */
    public function __construct(?array $rubrics = null, ?array $position = null)
    {
        $this->rubrics = $rubrics;
        $this->position = $position;
    }

    /**
     * @return array|null
     */
    public function getRubrics(): ?array
    {
        return $this->rubrics;
    }

    /**
     * @return null|string
     */
    public function getPosition()
    {
        return $this->position;
    }
}
