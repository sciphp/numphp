<?php

namespace SciPhp\NumPhp;

use SciPhp\NdArray;
use Webmozart\Assert\Assert;

trait VanderTrait
{
    /**
     * Generate a Vandermonde matrix.
     *
     * @param    \SciPhp\NdArray|array $matrix A 1-dim array.
     * @param    int $num Number of columns for the output.
     * @return \SciPhp\NdArray A Vandermonde matrix
     * @throws \InvalidArgumentException
     * @link http://sciphp.org/numphp.vander Documentation
     * @api
     */
    final public static function vander($matrix, $num = null): NdArray
    {
        static::transform($matrix, true);

        $num = null === $num ? count($matrix->data) : $num;

        Assert::integer($num);
        Assert::greaterThan($num, 0);
        Assert::eq($matrix->ndim, 1, __METHOD__ . '() only accepts vectors.');

        return static::ar(
            array_map(
                self::itemVander($num),
                static::ones(count($matrix->data), $num)->data,
                $matrix->data
            )
        );
    }

    /**
     * Apply decreasing power on each row values
     *
     * @param    int $num Number of wanted columns
     */
    final protected static function itemVander(int $num): callable
    {
        return function($row, $value) use ($num) {
            return array_map(
                function($key) use ($value, $num) {
                    return pow($value, $num - $key - 1);
                },
                array_keys($row)
            );
        };
    }
}
