<?php

namespace SciPhp\Random;

use SciPhp\NumPhp as np;

/**
 * Random generator methods.
 * It provides legacy numpy methods.
 * @see https://numpy.org/doc/stable/reference/random/legacy.html
 */
trait RandomStateTrait
{
    /**
     * Return a sample (or samples) from the “standard normal”
     * distribution..
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
