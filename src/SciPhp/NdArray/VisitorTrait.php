<?php

namespace SciPhp\NdArray;

use RecursiveIteratorIterator;
use SciPhp\NdArray;
use SciPhp\NumPhp as np;
use Webmozart\Assert\Assert;

/**
 * Visitor methods
 */
trait VisitorTrait
{
    /**
     * Walk on first dimension
     */
    final public function walk(callable $func, array &$data = null): NdArray
    {
        array_walk($this->data, $func);

        return $this;
    }

    /**
     * Walk on last dimension
     */
    final public function walk_recursive(callable $func): NdArray
    {
        array_walk_recursive($this->data, $func);

        return $this;
    }

    /**
     * Iterate on next value
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
     * @return int|NdArray
     */
    final public function axis(callable $func, $number = null, bool $keepdims = false)
    {
        if (!is_null($number)) {
            Assert::integer(
                $number,
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
            $index = $number == 0
                ? ": , $key"
                : "$key, :";

            $value = $func($this->offsetGet($index)->data);
        };

        // keepdims handling
        $targetShape = $this->shape;
        if ($keepdims) {
            $targetShape[$number] = 1;
        } else {
            unset($targetShape[$number]);
        }

        // No axis number
        if (is_null($number)) {
            if ($keepdims) {
                $targetShape = array_fill(0, $this->ndim, 1);
                return np::full($targetShape, $func($this->data));
            } else {
                return $func($this->data);
            }
        }

        return np::zeros($this->shape[$this->ndim - 1 - $number])
                 ->walk($fn)
                 ->reshape(...$targetShape);
    }
}
