<?php

namespace UrsusArctosUA\SearchHelper\Dictionary;

use UrsusArctosUA\SearchHelper\Filter as FilterInterface;
use UrsusArctosUA\SearchHelper\Order as OrderInterface;
use UrsusArctosUA\SearchHelper\Params as ParamsInterface;
use UrsusArctosUA\SearchHelper\Simple\Order;

/**
 * Class RequestParams
 * @package UrsusArctosUA\SearchHelper\Request
 */
class Params implements ParamsInterface
{
    /**
     * @var iterable<FilterInterface>
     */
    private $filters;

    /**
     * @var int|null
     */
    private $limit;

    /**
     * @var int
     */
    private $offset;

    /**
     * @var iterable<OrderInterface>
     */
    private $orders;

    /**
     * RequestParams constructor.
     *
     * @param iterable $filters
     * @param int $limit
     * @param int $offset
     * @param array $orders
     */
    public function __construct(
        iterable $filters,
        ?int $limit = 20,
        int $offset = 0,
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
        foreach ($this->filters as $field => $value) {
            yield new Filter($field, $value);
        }
    }

    /**
     * @return iterable<OrderInterface>
     */
    public function orders(): iterable
    {
        foreach ($this->orders as $field => $direction) {
            yield new Order($field, $direction);
        }
    }
}