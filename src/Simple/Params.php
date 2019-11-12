<?php

namespace UrsusArctosUA\SearchHelper\Simple;

use UrsusArctosUA\SearchHelper\Filter as FilterInterface;
use UrsusArctosUA\SearchHelper\Order as OrderInterface;
use UrsusArctosUA\SearchHelper\Params as ParamsInterface;

/**
 * Class Params
 * @package UrsusArctosUA\SearchHelper\Request
 */
class Params implements ParamsInterface
{
    /**
     * @var iterable<FilterInterface>
     */
    private $filters;

    /**
     * @var int
     */
    private $limit;

    /**
     * @var int|null
     */
    private $offset;

    /**
     * @var iterable<OrderInterface>
     */
    private $orders;

    /**
     * Params constructor.
     *
     * @param iterable<FilterInterface> $filters
     * @param int $limit
     * @param int|null $offset
     * @param iterable<OrderInterface> $orders
     */
    public function __construct(
        iterable $filters,
        int $limit,
        ?int $offset = null,
        iterable $orders = []
    ) {
        $this->filters = $filters;
        $this->limit = $limit;
        $this->offset = $offset;
        $this->orders = $orders;
    }

    /**
     * @return int
     */
    public function offset(): int
    {
        return $this->offset;
    }

    /**
     * @return int|null
     */
    public function limit(): ?int
    {
        return $this->limit;
    }

    /**
     * @return iterable<FilterInterface>
     */
    public function filters(): iterable
    {
        return $this->filters;
    }

    /**
     * @return iterable<OrderInterface>
     */
    public function orders(): iterable
    {
        return $this->orders;
    }
}