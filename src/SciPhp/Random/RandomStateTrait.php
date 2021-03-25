<?php

namespace SciPhp\Random;

use SciPhp\NdArray;
use SciPhp\NumPhp as np;
use Webmozart\Assert\Assert;

/**
 * Random generator methods.
 * It provides legacy numpy methods.
 * @see https://numpy.org/doc/stable/reference/random/legacy.html
 */
trait RandomStateTrait
{
    /**
     * Return a sample (or samples) from the “standard normal”
     * distribution.
     * 
     * @param  array<int> $args Shape of the destination matrix
     *              if nothing is passed, return a random float
     * @return \SciPhp\NdArray|float
     * 
     * @link http://sciphp.org/random.randn
     * Documentation for randn()
     * 
     * @since 0.5.0
     * @api
     */
    final public function randn()
    {
        if (func_num_args() === 0) {
            return $this->nrand(0, 1);
        }

        $args = np::parseArgs(func_get_args());

        $func = function(&$element) {
            $element = $this->nrand(0, 1);
        };

        return np::nulls($args)->walk_recursive($func);
    }

    /**
     * Random values in a given shape.
     * 
     * @param  array<int> $args Shape of the destination matrix
     * @return \SciPhp\NdArray
     * 
     * @link http://sciphp.org/random.rand
     * Documentation for rand()
     * 
     * @since 0.5.0
     * @api
     */
    final public function rand(): NdArray
    {
        Assert::greaterThan(
            func_num_args(),
            0,
            'Method rand() must have at least one parameter. Got: %s'
        );

        $args = np::parseArgs(func_get_args());

        $func = function(&$element) {
            $element = $this->randomFloat();
        };

        return np::nulls($args)->walk_recursive($func);
    }

    /**
     * Return random integers from low (inclusive) to high (exclusive).
     * 
     * @param  int|int[] $size Shape of the output matrix
     * @return \SciPhp\NdArray|int
     * 
     * @link http://sciphp.org/random.randint
     * Documentation for randint()
     * 
     * @since 0.5.0
     * @api
     */
    final public function randint(int $low, int $high = null, $size = null)
    {
        $min = is_null($high) ? 0    : $low;
        $max = is_null($high) ? $low : $high;
        
        Assert::greaterThan(
            $max,
            $min
        );

        $range  = np::arange($min, $max)->data;

        if (is_null($size)) {
            return $range[ array_rand($range) ];
        }

        $func = function(&$element) use ($range) {
            $element = $range[ array_rand($range) ];
        };

        return np::nulls($size)->walk_recursive($func);
    }

    private function randomFloat(): float
    {
        return mt_rand() / mt_getrandmax();
    }

    
    private function nrand($mean, $sd): float
    {
        $x = $this->randomFloat();
        $y = $this->randomFloat();

        return sqrt(-2 * log($x)) * cos(2 * pi() * $y) * $sd + $mean;
    }
}
