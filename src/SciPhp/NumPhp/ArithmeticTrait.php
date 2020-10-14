<?php

namespace SciPhp\NumPhp;

use RecursiveArrayIterator;
use RecursiveIteratorIterator;
use SciPhp\Exception\Message;
use SciPhp\NdArray;
use Webmozart\Assert\Assert;

trait ArithmeticTrait
{
    /**
     * Return the reciprocal of the argument, element-wise.
     *
     * @param \SciPhp\NdArray|array|float|int $m
     * @link http://sciphp.org/numphp.reciprocal
     *    Documentation for reciprocal() method
     * @api
     */
    final public static function reciprocal($m)
    {
        if (is_numeric($m)) {
            Assert::notEq(0, $m);

            return 1 / $m;
        }

        static::transform($m, true);

        return static::ones($m->shape)->divide($m);
    }

    /**
     * Subtract a matrix from matrix
     *
     * @param \SciPhp\NdArray|array|float|int $m
     * @param \SciPhp\NdArray|array|float|int $n
     * @link http://sciphp.org/numphp.subtract Documentation
     * @api
     */
    final public static function subtract($m, $n)
    {
        if (static::allNumeric($m, $n)) {
            return $m - $n;
        }

        static::transform($n);

        // lambda - array
        if (is_numeric($m) && $n instanceof NdArray) {
            return static::full_like($n, $m)->subtract($n);
        }

        // array - array
        static::transform($m, true);

        // array - array OR array - lambda
        return $m->negative()->add($n)->negative();
    }

    /**
     * Add two array_like
     *
     * @param  \SciPhp\NdArray|array|int|float $m
     * @param  \SciPhp\NdArray|array|int|float $n
     * @return \SciPhp\NdArray|int|float
     * @link http://sciphp.org/numphp.add Documentation
     * @api
     */
    final public static function add($m, $n)
    {
        if (static::allNumeric($m, $n)) {
            return $m + $n;
        }

        static::transform($n);

        // lambda + array
        if (is_numeric($m) && $n instanceof NdArray) {
            return $n->copy()->add($m);
        }

        // array + array
        static::transform($m, true);

        // array + array OR array + lambda
        return $m->copy()->add($n);
    }

    /**
     * Divide two arrays, element-wise
     *
     * @param  \SciPhp\NdArray|array|float|int $m A 2-dim array.
     * @param  \SciPhp\NdArray|array|float|int $n A 2-dim array.
     * @return \SciPhp\NdArray|float|int
     * @throws \InvalidArgumentException
     * @link http://sciphp.org/numphp.divide
     *    Documentation for divide()
     * @api
     */
    final public static function divide($m, $n)
    {
        if (static::allNumeric($m, $n)) {
            Assert::notEq(0, $n);

            return $m / $n;
        }

        static::transform($m);
        static::transform($n);

        // array / lamba
        if (is_numeric($n) && $m instanceof NdArray) {
            return $m->copy()->divide($n);
        }

        // lamba / array
        if (is_numeric($m) && $n instanceof NdArray) {
            return static::full_like($n, $m)->divide($n);
        }

        // array / array
        Assert::isInstanceof($m, 'SciPhp\NdArray');
        Assert::isInstanceof($n, 'SciPhp\NdArray');

        $shape_m = $m->shape;
        $shape_n = $n->shape;

        // n & m are vectors:
        if (count($shape_m) == 1 && $m->ndim == $n->ndim) {
            Assert::eq($shape_m, $shape_n, Message::MAT_NOT_ALIGNED);
        }

        // n is a vector
        elseif (!isset($shape_n[1])) {
            Assert::eq($shape_m[1], $shape_n[0], Message::MAT_NOT_ALIGNED);
        }

        // m is a vector
        elseif (!isset($shape_m[1])) {
            Assert::eq($shape_m[0], $shape_n[1], Message::MAT_NOT_ALIGNED);

            $m = $m->resize($shape_n);
        }

        // array / array -> broadcast
        elseif ($m->ndim === $n->ndim && $shape_m[0]==$shape_n[0] && $shape_m[1] > $shape_n[1]) {
            $n = static::broadcast_to($n, $shape_m);
        }

        // array / array
        elseif ($m->ndim === $n->ndim) {
            Assert::eq($shape_m, $shape_n, Message::MAT_NOT_ALIGNED);
        }

        $iterator = new RecursiveIteratorIterator(
            new RecursiveArrayIterator($n->data),
            RecursiveIteratorIterator::LEAVES_ONLY
        );

        $func = function(&$item) use (&$iterator, $n) {
            Assert::notEq(0, $value = $n->iterate($iterator));
            $item /= $value;
        };

        return $m->copy()->walk_recursive($func);
    }

    /**
     * Multiply two arrays, element-wise
     *
     * @param  \SciPhp\NdArray|array|float|int $m A 2-dim array.
     * @param  \SciPhp\NdArray|array|float|int $n A 2-dim array.
     * @return \SciPhp\NdArray|float|int
     * @throws \InvalidArgumentException
     * @link http://sciphp.org/numphp.multiply Documentation
     * @api
     */
    final public static function multiply($m, $n)
    {
        if (static::allNumeric($m, $n)) {
            return $m * $n;
        }

        static::transform($m);
        static::transform($n);

        // array * lamba
        if (is_numeric($n) && $m instanceof NdArray) {
            return $m->copy()->dot($n);
        }

        // lamba * array
        if (is_numeric($m) && $n instanceof NdArray) {
            return $n->copy()->dot($m);
        }

        // array * array
        Assert::isInstanceof($m, NdArray::class);
        Assert::isInstanceof($n, NdArray::class);

        $shape_m = $m->shape;
        $shape_n = $n->shape;

        // n & m are vectors:
        if (count($shape_m) == 1 && $m->ndim == $n->ndim) {
            Assert::eq($shape_m, $shape_n, Message::MAT_NOT_ALIGNED);
        }

        // n is a vector
        elseif (!isset($shape_n[1])) {
            Assert::eq($shape_m[1], $shape_n[0], Message::MAT_NOT_ALIGNED);
        }

        // m is a vector
        elseif (!isset($shape_m[1])) {
            Assert::eq($shape_m[0], $shape_n[1], Message::MAT_NOT_ALIGNED);

            $m = $m->resize($shape_n);
        }

        // array * array
        elseif ($m->ndim === $n->ndim) {
            Assert::eq($shape_m, $shape_n, Message::MAT_NOT_ALIGNED);
        }

        $iterator = new RecursiveIteratorIterator(
            new RecursiveArrayIterator($n->data),
            RecursiveIteratorIterator::LEAVES_ONLY
        );

        $func = function(&$item) use (&$iterator, $n) {
            $item *= $n->iterate($iterator);
        };

        return $m->copy()->walk_recursive($func);
    }

    /**
     * Dot product of two arrays
     *
     * @param  \SciPhp\NdArray|array|float|int $m A 2-dim array.
     * @param  \SciPhp\NdArray|array|float|int $n A 2-dim array.
     * @return \SciPhp\NdArray|float|int
     * @throws \InvalidArgumentException
     * @link http://sciphp.org/numphp.dot Documentation
     * @api
     */
    final public static function dot($m, $n)
    {
        if (static::allNumeric($m, $n)) {
            return $m * $n;
        }

        static::transform($m);
        static::transform($n);

        // array.lamba
        if (is_numeric($n) && $m instanceof NdArray) {
            return $m->copy()->dot($n);
        }

        // lamba.array
        if (is_numeric($m) && $n instanceof NdArray) {
            return $n->copy()->dot($m);
        }

        // array.array
        Assert::isInstanceof($m, 'SciPhp\NdArray');
        Assert::isInstanceof($n, 'SciPhp\NdArray');

        $shape_m = $m->shape;
        $shape_n = $n->shape;

        // n & m are vectors:
        if (count($shape_m) == 1 && $m->ndim == $n->ndim) {
            Assert::eq($shape_m, $shape_n, Message::MAT_NOT_ALIGNED);

            return array_sum(
                array_map(
                    function($el_m, $el_n) {
                        return $el_m * $el_n;
                    },
                    $m->data,
                    $n->data
                )
            );
        }

        // n is a vector
        if (!isset($shape_n[1])) {
            Assert::eq($shape_m[1], $shape_n[0], Message::MAT_NOT_ALIGNED);

            return static::zeros($shape_m[0], 1)
                ->walk(
                    self::rowDot(
                        $m,
                        $n->reshape($shape_n[0], 1)
                    )
                ) ->reshape($shape_m[0]);
        }

        // m is a vector
        if (!isset($shape_m[1])) {
            Assert::eq($shape_m[0], $shape_n[0], Message::MAT_NOT_ALIGNED);

            $callback = function(&$item, $k_m) use ($m, $n) {
                $item = array_sum(
                    array_map(
                        function($el_n, $el_m) {
                            return $el_n * $el_m;
                        },
                        $m->data,
                        array_column($n->data, $k_m)
                    )
                );
            };

            return static::zeros($shape_n[1])->walk($callback);
        }

        Assert::eq($shape_m[1], $shape_n[0], Message::MAT_NOT_ALIGNED);

        return static::zeros($shape_m[0], $shape_n[1])->walk(
                         self::rowDot($m, $n)
        );
    }

    /**
     * Browse p rows
     *
     * @param  \SciPhp\NdArray $m
     * @param  \SciPhp\NdArray $n
     */
    final protected static function rowDot(NdArray $m, NdArray $n): callable
    {
        return function(&$row, $row_m) use ($m, $n) {
            array_walk($row, self::colDot($row_m, $m, $n));
        };
    }

    /**
     * Browse p cols and sum products
     *
     * @param  \SciPhp\NdArray $m
     * @param  \SciPhp\NdArray $n
     * @return \Closure
     */
    final protected static function colDot($row_m, NdArray $m, NdArray $n)
    {
        // row_m * col_n
        return function(&$item, $col_m) use ($row_m, $m, $n) {
            $item = array_sum(
                array_map(
                    function($el_m, $row_n) use ($col_m) {
                        return $el_m * $row_n[$col_m];
                    },
                    $m->data[$row_m],
                    $n->data
                )
            );
        };
    }
}
