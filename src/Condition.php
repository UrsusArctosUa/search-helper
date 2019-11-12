<?php

namespace UrsusArctosUA\SearchHelper;

/**
 * Interface Condition
 * @package UrsusArctosUA\SearchHelper
 */
abstract class Condition
{
    const EQ = 'eq';
    const GE = 'gte';
    const GT = 'gt';
    const IN = 'in';
    const LE = 'lte';
    const LT = 'lt';

    /**
     * @return string[]
     */
    public static function conditions(): array
    {
        return [self::IN, self::EQ, self::LT, self::LE, self::GT, self::GE];
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