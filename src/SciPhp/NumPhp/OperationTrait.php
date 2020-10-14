<?php

namespace SciPhp\NumPhp;

use Webmozart\Assert\Assert;

trait OperationTrait
{
    /**
     * Sum all elements.
     *
     * @param  \SciPhp\NdArray|array|int|float $m
     * @param  int|null $axis
     * @param  bool     $keepdims
     * @return int|float
     * @link http://sciphp.org/numphp.sum Documentation
     * @api
     */
    final public static function sum($m, $axis = null, bool $keepdims = false)
    {
        if (is_numeric($m)) {
            return $m;
        }

        static::transform($m, true);

        $func = function(array $array) use (&$func) {
            return isset($array[0]) && is_array($array[0])
                            ? array_sum(array_map($func, $array))
                            : array_sum($array);
        };

        return $m->axis($func, $axis, $keepdims);
    }

    /**
     * Integrate along the given axis using the composite trapezoidal rule.
     *
     * @param    \SciPhp\NdArray|array $m
     * @return int|float|array
     * @link http://sciphp.org/numphp.trapz Documentation
     * @todo implement dx, x options parameters
     * @api
     */
    final public static function trapz($m)
    {
        static::transform($m, true);

        Assert::eq(1, $m->ndim);

        // dx = 1
        $func = function($value, $key) use (& $prev) {
            if ($key === 0) {
                $prev = $value;

                return 0;
            }

            $sum = ($value + $prev) / 2;

            $prev = $value;

            return $sum;
        };

        return array_sum(
            array_map(
                $func,
                $m->data,
                array_keys($m->data)
            )
        );
    }
}
