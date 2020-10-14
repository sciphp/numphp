<?php

namespace SciPhp\NumPhp;

use Webmozart\Assert\Assert;
use SciPhp\Exception\Message;

/**
 * Exponent methods
 */
trait ExponentTrait
{
    /**
     * Calculate the exponential of all elements in the input array.
     *
     * @param  \SciPhp\NdArray|array|int|float $m
     * @return \SciPhp\NdArray|int|float
     * @link http://sciphp.org/numphp.exp Documentation
     * @api
     */
    final public static function exp($m)
    {
        if (\is_numeric($m)) {
            return exp($m);
        }

        static::transform($m, true);

        $func = function(&$element) {
            $element = exp($element);
        };

        return $m->copy()->walk_recursive($func);
    }

    /**
     * Calculate exp(x) - 1 for all elements in the array.
     *
     * @param  \SciPhp\NdArray|array|int|float $m
     * @return \SciPhp\NdArray|int|float
     * @link http://sciphp.org/numphp.expm1 Documentation
     * @api
     */
    final public static function expm1($m)
    {
        if (\is_numeric($m)) {
            return expm1($m);
        }

        static::transform($m, true);

        $func = function(&$element) {
            $element = expm1($element);
        };

        return $m->copy()->walk_recursive($func);
    }

    /**
     * Calculate 2**p for all p in the input array.
     *
     * @param  \SciPhp\NdArray|array|int|float $m
     * @return \SciPhp\NdArray|int|float
     * @link http://sciphp.org/numphp.exp2 Documentation
     * @api
     */
    final public static function exp2($m)
    {
        if (\is_numeric($m)) {
            return 2 ** $m;
        }

        static::transform($m, true);

        $func = function(&$element) {
            $element = 2 ** $element;
        };

        return $m->copy()->walk_recursive($func);
    }

    /**
     * Matrix elements raised to powers.
     *
     * @param  float|int|array|\SciPhp\NdArray $matrix
     * @param  float|int $exponent
     * @link http://sciphp.org/numphp.power Documentation
     * @since 0.3.0
     * @api
     */
    final public static function power($matrix, $exponent)
    {
        Assert::numeric($exponent);

        if (\is_numeric($matrix)) {
            return $matrix ** $exponent;
        }

        static::transform($matrix, true);

        $func = function(&$element) use ($exponent) {
            $element = $element ** $exponent;
        };

        return $matrix->copy()->walk_recursive($func);
    }

    /**
     * The element-wise square of the input.
     *
     * @param  float|int|array|\SciPhp\NdArray $matrix
     * @return float|int|\SciPhp\NdArray
     * @link   http://sciphp.org/numphp.square Documentation
     * @since  0.3.0
     * @api
     */
    final public static function square($matrix)
    {
        if (\is_numeric($matrix)) {
            return $matrix ** 2;
        }

        static::transform($matrix, true);

        return $matrix->power(2);
    }

    /**
     * The non-negative square-root of an array, element-wise.
     *
     * @return \SciPhp\NdArray
     * @link   http://sciphp.org/ndarray.sqrt Documentation
     * @since  0.3.0
     * @api
     */
    final public static function sqrt($matrix)
    {
        if (\is_numeric($matrix)) {
            Assert::greaterThanEq(
                $matrix,
                0,
                Message::ONLY_POSITIVE_NUMBER
            );

            return sqrt($matrix);
        }

        static::transform($matrix, true);

        $func = function(&$element) {
            Assert::greaterThanEq(
                $element,
                0,
                Message::ONLY_POSITIVE_NUMBER
            );

            $element = sqrt($element);
        };

        return $matrix->copy()->walk_recursive($func);
    }
}
