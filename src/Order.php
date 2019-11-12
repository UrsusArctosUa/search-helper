<?php

namespace UrsusArctosUA\SearchHelper;

/**
 * Interface Order
 * @package UrsusArctosUA\SearchHelper
 */
interface Order
{
    const ASC  = 'ASC';
    const DESC = 'DESC';

    /**
     * @return string
     */
    public function name(): string;

    /**
     * @return string
     */
    public function direction(): string;

}