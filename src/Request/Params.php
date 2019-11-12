<?php

namespace UrsusArctosUA\SearchHelper\Request;

use UrsusArctosUA\SearchHelper\Filter as FilterInterface;
use UrsusArctosUA\SearchHelper\Params as ParamsInterface;
use UrsusArctosUA\SearchHelper\Order as OrderInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class Params
 * @package UrsusArctosUA\SearchHelper\Request
 */
class Params implements ParamsInterface
{
    /**
     * @var int
     */
    private $limit;

    /**
     * @var Request
     */
    private $request;

    /**
     * Params constructor.
     *
     * @param Request $request
     * @param int $limit
     */
    public function __construct(Request $request, int $limit = 20)
    {
        $this->request = $request;
        $this->limit = $limit;
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
        return $this->request->get('limit', $this->limit);
    }

    /**
     * @return iterable<FilterInterface>
     */
    public function filters(): iterable
    {
        foreach ($this->request->get('filter', []) as $name => $value) {
            yield new Filter($name, $value);
        }
    }

    /**
     * @return iterable<OrderInterface>
     */
    public function orders(): iterable
    {
        foreach ($this->request->get('order_by', []) as $name => $direction) {
            yield new Order($name, $direction);
        }
    }
}