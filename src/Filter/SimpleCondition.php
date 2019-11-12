<?php

namespace UrsusArctosUA\SearchHelper\Filter;

/**
 * Class SimpleCondition
 * @package UrsusArctosUA\SearchHelper
 */
class SimpleCondition extends Condition
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var mixed
     */
    private $value;

    /**
     * SimpleCondition constructor.
     *
     * @param string $name
     * @param mixed $value
     */
    public function __construct(string $name, $value)
    {
        $this->name = $name;
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function value()
    {
        return $this->value;
    }
}