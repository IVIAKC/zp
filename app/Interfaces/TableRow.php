<?php

namespace App\Interfaces;

/**
 * Interface TableRow
 * @package App\Interfaces
 */
interface TableRow
{
    public function increaseCount(): void;

    /**
     * @return int
     */
    public function getCount(): int;

    /**
     * @return string
     */
    public function getTitle(): string;
}