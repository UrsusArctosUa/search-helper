<?php

namespace UrsusArctosUA\SearchHelper;

/**
 * Interface Condition
 * @package UrsusArctosUA\SearchHelper
 */
abstract class Condition
{
    const EQ          = 'eq';
    const GE          = 'gte';
    const GT          = 'gt';
    const IN          = 'in';
    const IS_NOT_NULL = 'isNotNull';
    const IS_NULL     = 'isNull';
    const LE          = 'lte';
    const LT          = 'lt';
    const NOT_EQ      = 'neq';
    const NOT_IN      = 'notIn';

    /**
     * @return string[]
     */
    public static function conditions(): array
    {
        return [
            self::IN,
            self::NOT_IN,
            self::EQ,
            self::NOT_EQ,
            self::LT,
            self::LE,
            self::GT,
            self::GE,
            self::IS_NULL,
            self::IS_NOT_NULL,
        ];
    }

    /**
     * @return string
     */
    abstract public function name(): string;

    /**
     * @return mixed
     */
    abstract public function value();
}