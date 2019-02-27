<?php

namespace App\Entity;

class Vacancy
{
    /** @var array|null $rubrics */
    protected $rubrics;

    /** @var string $name */
    protected $position;

    public function __construct(?array $rubrics = null, ?array $position = null)
    {
        $this->rubrics = $rubrics;
        $this->position = $position;
    }

    public function getRubrics(): ?array
    {
        return $this->rubrics;
    }

    public function getPosition()
    {
        return $this->position;
    }
}
