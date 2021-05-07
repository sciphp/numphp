<?php

declare(strict_types=1);

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
     * @link http://sciphp.org/numphp.ar Documentation
     * @api
     */
    public static function ar(array $data, ?string $identifier = null): NdArray
    {
        return new NdArray($data, $identifier);
    }

    /**
     * Parse args as a tuple or an array
     *
     * @param  array|array<array> $args
     * @api
     */
    public static function parseArgs(array $args): array
    {
        if (isset($args[0]) && \is_array($args[0])) {
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
     * @param array|NdArray $m
     */
    public static function transform(&$m, bool $required = false): void
    {
        if (\is_array($m)) {
            $m = self::ar($m);
        }

        if ($required) {
            Assert::isInstanceof($m, NdArray::class);
        }
    }

    /**
     * Check that all values are numeric
     *
     * @api
     */
    public static function allNumeric(): bool
    {
        return ! count(
            array_filter(
                func_get_args(),
                static function ($value): bool {
                    return ! is_numeric($value);
                }
            )
        );
    }
}
