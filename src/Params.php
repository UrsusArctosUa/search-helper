<?php

namespace UrsusArctosUA\SearchHelper;

/**
 * Interface Params
 * @package UrsusArctosUA\SearchHelper
 */
interface Params
{
    /**
     * @return int
     */
    public function offset(): int;

    /**
     * @return int|null
     */
    public function limit(): ?int;

    /**
     * @return iterable<Filter>
     */
    public function filters(): iterable;

    /**
     * @return iterable<Order>
     */
    public function orders(): iterable;
}