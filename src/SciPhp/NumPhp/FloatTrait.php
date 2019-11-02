<?php

namespace SciPhp\NumPhp;

use RecursiveArrayIterator;
use RecursiveIteratorIterator;
use SciPhp\Exception\Message;
use SciPhp\NdArray;
use SciPhp\NumPhp as np;
use Webmozart\Assert\Assert;

/**
 * Floating point methods
 */
trait FloatTrait
{
    /**
     * Returns element-wise true where signbit is set (less than zero).
     * 
     * @param  \SciPhp\NdArray|array|int|float $m
     * @return \SciPhp\NdArray|bool
     * @link http://sciphp.org/numphp.signbit Documentation
     * @api
     */
    final public static function signbit($m)
    {
        if (is_numeric($m)) {
            return $m < 0;
        }

        static::transform($m, true);

        $func = function(&$element) {
            $element = $element < 0;
        };

        return $m->copy()->walk_recursive($func);
    }

    /**
     * Change the sign of m-element to that of n-element, element-wise.
     * 
     * @param  \SciPhp\NdArray|array|int|float $m
     * @param  \SciPhp\NdArray|array|int|float $n
     * @return \SciPhp\NdArray|int|float
     * @link http://sciphp.org/numphp.copysign Documentation
     * @api
     */
    final public static function copysign($m, $n)
    {
        if (static::allNumeric($m, $n)) {
            return np::signbit($m) == np::signbit($n)
                ? $m : -$m;
        }

        static::transform($m);
        static::transform($n);

        // array / lamba
        if (is_numeric($n) && $m instanceof NdArray) {
            return $m->copysign(static::full_like($m, $n));
            // return np::copysign($n, $m); //$m->copy()->copysign($n);
        }

        // lamba / array
        if (is_numeric($m) && $n instanceof NdArray) {
            return static::full_like($n, $m)->copysign($n);
        }

        // array / array
        Assert::isInstanceof($m, NdArray::class);
        Assert::isInstanceof($n, NdArray::class);

        // n & m are vectors: 
        if (count($m->shape) == 1 && $m->ndim == $n->ndim) {
            Assert::eq($m->shape, $n->shape, Message::MAT_NOT_ALIGNED);
        }

        // n is a vector
        elseif (!isset($n->shape[1])) {
            Assert::eq($m->shape[1], $n->shape[0], Message::MAT_NOT_ALIGNED);
        }

        // m is a vector
        elseif (!isset($m->shape[1])) {
            Assert::eq($m->shape[0], $n->shape[1], Message::MAT_NOT_ALIGNED);

            $m = $m->resize($n->shape);
        }

        // array / array
        elseif ($m->ndim === $n->ndim) {
            Assert::eq($m->shape, $n->shape, Message::MAT_NOT_ALIGNED);
        }

        $iterator = new RecursiveIteratorIterator(
            new RecursiveArrayIterator($n->data),
            RecursiveIteratorIterator::LEAVES_ONLY
        );

        $func = function(&$item) use (&$iterator, $n) {
            if (np::signbit($item) !== np::signbit($n->iterate($iterator))) {
                $item = -$item;
            }
        };

        return $m->copy()->walk_recursive($func);
    }
}
