<?php

namespace UrsusArctosUA\SearchHelper;

use UrsusArctosUA\SearchHelper\Filter\Condition;

/**
 * Interface Filter
 * @package UrsusArctosUA\SearchHelper
 */
interface Filter
{
    /**
     * @return string
     */
    public function name():string;

    /**
     * @return mixed
     */
    public function value();

    /**
     * @return iterable<Condition>
     */
    public function conditions():iterable;

}