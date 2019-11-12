<?php

namespace UrsusArctosUA\SearchHelper\Request;

use UrsusArctosUA\SearchHelper\Filter as FilterInterface;
use UrsusArctosUA\SearchHelper\Filter\Condition;
use UrsusArctosUA\SearchHelper\Filter\SimpleCondition;

/**
 * Class Filter
 * @package UrsusArctosUA\SearchHelper\Request
 */
class Filter implements FilterInterface
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var
     */
    private $value;

    /**
     * Filter constructor.
     *
     * @param string $name
     * @param $value
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

    /**
     * @return iterable<Condition>
     */
    public function conditions(): iterable
    {
        if (is_array($this->value)) {
            if (empty(array_diff(array_keys($this->value), Condition::conditions()))) {
                foreach ($this->value as $condition => $value) {
                    yield new SimpleCondition($condition, $value);
                }
            } else {
                yield new SimpleCondition(Condition::IN, $this->value);
            }
        } else {
            yield new SimpleCondition(Condition::EQ, $this->value);
        }

    }
}