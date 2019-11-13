<?php

namespace UrsusArctosUA\SearchHelper\Request;

use Symfony\Component\HttpFoundation\Request;
use UrsusArctosUA\SearchHelper\Params as ParamsInterface;

/**
 * Interface Params
 * @package UrsusArctosUA\SearchHelper\Request
 */
interface Params extends ParamsInterface
{
    /**
     * Params constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request);
}