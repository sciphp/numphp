<?php

namespace SciPhp\NumPhp;

use Webmozart\Assert\Assert;

trait LogarithmTrait
{
    /**
     * Natural logarithm, element-wise.
     *
     * @param  \SciPhp\NdArray|array|int|float $m
     * @param  int|float $base
     * @return \SciPhp\NdArray|int|float
     * @link http://sciphp.org/numphp.log Documentation
     * @api
     */
    final public static function log($m, $base = M_E)
    {
        Assert::greaterThan($base, 0);

        if (is_numeric($m)) {
            Assert::greaterThan($m, 0);
            return log($m, $base);
        }

        static::transform($m, true);

        $func = function(&$element) use ($base) {
            Assert::greaterThan($element, 0);

            $element = log($element, $base);
        };

        return $m->copy()->walk_recursive($func);
    }

    /**
     * Base 10 logarithm, element-wise.
     *
     * @param  \SciPhp\NdArray|array|int|float $m
     * @return \SciPhp\NdArray|int|float
     * @link http://sciphp.org/numphp.log10 Documentation
     * @api
     */
    final public static function log10($m)
    {
        return self::log($m, 10);
    }

    /**
     * Base 2 logarithm, element-wise.
     *
     * @param \SciPhp\NdArray|array|int|float $m
     * @return \SciPhp\NdArray|int|float
     * @link http://sciphp.org/numphp.log2 Documentation
     * @api
     */
    final public static function log2($m)
    {
        return self::log($m, 2);
    }
}
