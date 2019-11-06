<?php

namespace SciPhp\NumPhp\Mathematical;

/**
 * Trigonometric methods
 */
trait TrigonometricTrait
{
    /**
     * Cosine element-wise.
     *
     * @param  \SciPhp\NdArray|array|int|float $m
     * @return \SciPhp\NdArray|int|float
     * @link http://sciphp.org/numphp.cos Documentation
     * @api
     */
    final public static function cos($m)
    {
        if (\is_numeric($m)) {
            return cos($m);
        }

        static::transform($m, true);

        $func = function(&$element) {
            $element = cos($element);
        };

        return $m->copy()->walk_recursive($func);
    }
}
