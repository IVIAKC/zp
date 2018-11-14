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
     */
    public function __construct(string $title)
    {
        $this->title = $title;
        $this->count = 1;
    }

    public function increaseCount(): void
    {
        $this->count += 1;
    }

    /**
     * @return int
     */
    public function getCount()
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
