<?php

namespace SciPhp;

use SciPhp\Exception\Message;
use SciPhp\NumPhp\Decorator;
use Webmozart\Assert\Assert;

/**
 * Entry point for np calls.
 *
 * @link http://sciphp.org/ref.numphp
 */
final class NumPhp extends Decorator
{
    /**
     * Construct a n-dimensional array
     *
     * @param  array $data
     * @param  string $identifier
     * @return \SciPhp\NdArray
     * @link http://sciphp.org/numphp.ar Documentation
     * @api
     */
    final public static function ar(array $data, $identifier = null): NdArray
    {
        return new NdArray($data, $identifier);
    }

    /**
     * Parse args as a tuple or an array
     *
     * @param  array|array[] $args
     * @return array
     * @api
     */
    final public static function parseArgs(array $args): array
    {
        if (isset($args[0]) && is_array($args[0])) {
            Assert::oneOf(
                self::ar($args[0])->ndim,
                [0, 1],
                Message::ARG_NOT_ARRAY_TUPLE
            );

            Assert::allNumeric($args[0]);

            return $args[0];
        }

        Assert::allNumeric($args);

        return $args;
    }

    /**
     * Transform a PHP array in a NdArray
     *
     * @param mixed $m
     * @param bool  $required
     */
    final public static function transform(&$m, bool $required = false): void
    {
        if (is_array($m)) {
            $m = static::ar($m);
        }

        if ($required) {
            Assert::isInstanceof($m, 'SciPhp\NdArray');
        }
    }

    /**
     * Check that all values are numeric
     *
     * @param  array $args
     * @api
     */
    final public static function allNumeric(): bool
    {
        return !count(
            array_filter(
                func_get_args(),
                function ($value) {
                    return !is_numeric($value);
                }
            )
        );
    }
}
