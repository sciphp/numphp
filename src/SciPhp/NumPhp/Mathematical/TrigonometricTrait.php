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
     * @since 0.4.0
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

    /**
     * Trigonometric sine, element-wise.
     *
     * @param  \SciPhp\NdArray|array|int|float $m
     * @return \SciPhp\NdArray|int|float
     * @link http://sciphp.org/numphp.sin Documentation
     * @since 0.4.0
     * @api
     */
    final public static function sin($m)
    {
        if (\is_numeric($m)) {
            return sin($m);
        }

        static::transform($m, true);

        $func = function(&$element) {
            $element = sin($element);
        };

        return $m->copy()->walk_recursive($func);
    }

    /**
     * Compute tangent element-wise.
     * 
     * Equivalent to np::sin(x)->divide(np::cos(x)) element-wise.
     *
     * @param  \SciPhp\NdArray|array|int|float $m
     * @return \SciPhp\NdArray|int|float
     * @link http://sciphp.org/numphp.tan Documentation
     * @since 0.5.0
     * @api
     */
    final public static function tan($m)
    {
        if (\is_numeric($m)) {
            return tan($m);
        }

        static::transform($m, true);

        $func = function(&$element) {
            $element = tan($element);
        };

        return $m->copy()->walk_recursive($func);
    }
}
