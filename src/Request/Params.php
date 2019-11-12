<?php

namespace UrsusArctosUA\SearchHelper\Request;

use Symfony\Component\HttpFoundation\Request;
use UrsusArctosUA\SearchHelper\Filter as FilterInterface;
use UrsusArctosUA\SearchHelper\Order as OrderInterface;
use UrsusArctosUA\SearchHelper\Params as ParamsInterface;
use UrsusArctosUA\SearchHelper\Simple\Order;

/**
 * Class Params
 * @package UrsusArctosUA\SearchHelper\Request
 */
class Params implements ParamsInterface
{
    /**
     * @var array
     */
    private $defaultFilter;

    /**
     * @var int|null
     */
    private $defaultLimit;

    /**
     * @var array
     */
    private $defaultOrder;

    /**
     * @var Request
     */
    private $request;

    /**
     * Params constructor.
     *
     * @param Request $request
     * @param int $defaultLimit
     * @param array $defaultFilter
     * @param array $defaultOrder
     */
    public function __construct(
        Request $request,
        ?int $defaultLimit = 20,
        array $defaultFilter = [],
        array $defaultOrder = []
    ) {
        $this->request = $request;
        $this->defaultLimit = $defaultLimit;
        $this->defaultFilter = $defaultFilter;
        $this->defaultOrder = $defaultOrder;
    }

    /**
     * @return int
     */
    public function offset(): int
    {
        if (!is_null($offset = $this->request->get('offset'))) {
            return $offset;
        }
        if (!is_null($page = $this->request->get('page'))) {
            return $this->limit() * ($page - 1);
        }

        return 0;
    }

    /**
     * @return int|null
     */
    public function limit(): ?int
    {
        return $this->request->get('limit', $this->defaultLimit);
    }

    /**
     * @return iterable<FilterInterface>
     */
    public function filters(): iterable
    {
        foreach ($this->request->get('filter', $this->defaultFilter) as $name => $value) {
            yield new Filter($name, $value);
        }
    }

    /**
     * @return iterable<OrderInterface>
     */
    public function orders(): iterable
    {
        foreach ($this->request->get('order_by', $this->defaultOrder) as $name => $direction) {
            yield new Order($name, $direction);
        }
    }
}