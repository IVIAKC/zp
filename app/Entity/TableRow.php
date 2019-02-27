<?php

namespace App\Entity;

class TableRow
{
    /** @var string  */
    private $title;

    /** @var int  */
    private $count;

    public function __construct(string $title, int $count = 0)
    {
        $this->title = $title;
        $this->count = $count;
    }

    public function increaseCount(): void
    {
        $this->count++;
    }

    public function getCount(): int
    {
        return $this->count;
    }

    public function getTitle(): string
    {
        return $this->title;
    }
}

