<?php

namespace UrsusArctosUA\SearchHelper\Simple;

use UrsusArctosUA\SearchHelper\Condition as ConditionAbstract;

/**
 * Class Condition
 * @package UrsusArctosUA\SearchHelper
 */
class Condition extends ConditionAbstract
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
     * Condition constructor.
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