<?php

namespace App\Entity;

use App\Interfaces\TableRow as TableRowInterface;

/**
 * Class TableRow
 * @package App\Entity
 */
class TableRow implements TableRowInterface
{
    /** @var string $title */
    protected $title;
    /** @var int $count */
    protected $count;

    /**
     * TableRow constructor.
     * @param string $title
     * @param int $count
     */
    public function __construct(string $title, int $count = 0)
    {
        $this->title = $title;
        $this->count = $count;
    }

    public function increaseCount(): void
    {
        $this->count++;
    }

    /**
     * @return int
     */
    public function getCount(): int
    {
        return $this->count;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }
}

