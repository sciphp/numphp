<?php

namespace SciPhp\NdArray;

use RecursiveIteratorIterator;
use SciPhp\NumPhp as np;
use Webmozart\Assert\Assert;

/**
 * Visitor methods
 */
trait VisitorTrait
{
    /**
     * Walk on first dimension
     * 
     * @param callable $func
     * 
     * @return \SciPhp\NdArray
     */
    final public function walk(callable $func, array &$data = null)
    {
        null === $data
            ? array_walk($this->data, $func)
            : array_walk($data, $func);            

        return $this;
    }

    /**
     * Walk on last dimension
     * 
     * @param callable $func
     * 
     * @return \SciPhp\NdArray
     */
    final public function walk_recursive(callable $func)
    {
        array_walk_recursive($this->data, $func);

        return $this;
    }

    /**
     * Iterate on next value
     * 
     * @param \RecursiveIteratorIterator &$iterator
     * 
     * @return int|float
     */
    final public function iterate(RecursiveIteratorIterator &$iterator)
    {
        while ($iterator->valid()) {
            if (!is_array($iterator->current())) {
                $value = $iterator->current();

                $key = $iterator->key();

                $iterator->next();
                // At first iteration on 1 dim array, 
                // key is not incremented
                if ($key == $iterator->key()) {
                    $iterator->next();
                }

                return $value;
            } else {
                $iterator->next();
            }
        }

        $iterator->rewind();

        return $this->iterate($iterator);
    }

    /**
     * Execute axis operations and return an aggregate
     * 
     * @param  callable $func
     * @param  int|null $number Axis number
     * @param  bool     $keepdims
     * @return \SciPhp\NdArray
     */
    final public function axis(callable $func, $number = null, $keepdims = false)
    {
        if (!is_null($number)) {
            Assert::integer(
                $number,
                0, 
                "Axis number must be an integer. Given: %s"
            );

            Assert::greaterThanEq(
                $number,
                0, 
                "Axis number must be greater than 0. Given: %s"
            );

            Assert::lessThan(
                $number,
                $this->ndim,
                "Axis number must be lower than " 
                . ($this->ndim - 1)
                . 'Given: %s'
            );

            Assert::lessThanEq(
                $this->ndim,
                2,
                "Axis implementation does not support dimension > 2"
                . 'Given: %s'
            );
        }

        $fn = function(&$value, $key) use ($func, $number) {
                $k = $key + 1;
                if ($number == 0) {
                    $index = " , $k";
                } elseif ($number == 1) {
                    $index = "$k, ";
                }

                $value = $func($this->offsetGet($index)->data);
        };

        // keepdims handling
        $targetShape = $this->shape;
        if ($keepdims) {
            $targetShape[$number] = 1;
        } else {
            unset($targetShape[$number]);
        }
        
        if (is_null($number)) {
            if ($keepdims) {
                $targetShape = array_fill(0, $this->ndim, 1);
                return np::full($targetShape, $func($this->data));
            } else {
                return $func($this->data);
            }
        }

        return np::ar(
                array_fill(
                    0,
                    $this->shape[$this->ndim - 1 - $number], 
                    0
                )
        )
        ->walk($fn)
        ->reshape(array_values($targetShape));
    }
}
