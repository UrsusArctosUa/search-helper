<?php

namespace UrsusArctosUA\SearchHelper\Simple;

use UrsusArctosUA\SearchHelper\Order as OrderInterface;

/**
 * Class Order
 * @package UrsusArctosUA\SearchHelper\Request
 */
class Order implements OrderInterface
{

    /**
     * @var string
     */
    private $direction;

    /**
     * @var string
     */
    private $name;

    /**
     * Order constructor.
     *
     * @param string $name
     * @param string $direction
     */
    public function __construct(string $name, string $direction)
    {
        $this->name = $name;
        $this->direction = $direction;
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function direction(): string
    {
        return $this->direction;
    }
}