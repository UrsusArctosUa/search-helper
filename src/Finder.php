<?php

namespace UrsusArctosUA\SearchHelper;

/**
 * Interface Finder
 * @package UrsusArctosUA\SearchHelper
 */
interface Finder
{
    /**
     * @param $entity
     * @param Params $params
     *
     * @return iterable
     */
    public function search($entity, Params $params): iterable;

    /**
     * @param $entity
     * @param Params $params
     *
     * @return int
     */
    public function count($entity, Params $params): int;

}