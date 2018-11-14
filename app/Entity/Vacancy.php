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

    /** @var string $id */
    protected $id;

    /** @var array|null $rubrics */
    protected $rubrics;

    /** @var null|string  */
    protected $word;

    /**
     * Vacancy constructor.
     * @param int $id
     * @param array|null $rubrics
     * @param null|array $word
     */
    public function __construct(int $id, ?array $rubrics = null, ?array $word = null)
    {
        $this->rubrics = $rubrics;
        $this->word = $word;
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
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
    public function getWord()
    {
        return $this->word;
    }
}
