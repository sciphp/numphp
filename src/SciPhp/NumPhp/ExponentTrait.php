<?php

namespace SciPhp\NumPhp;

use Webmozart\Assert\Assert;

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

        return $m->exp();
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

        return $m->expm1();
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

        return $m->exp2();
    }

    /**
     * Matrix elements raised to powers.
     *
     * @param  float|int|array|\SciPhp\NdArray $matrix
     * @param  float|int $exponent
     * @return \SciPhp\NdArray
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

        return $matrix->power($exponent);
    }
}
