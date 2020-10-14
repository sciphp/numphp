<?php

namespace SciPhp\NdArray;

use RecursiveArrayIterator;
use RecursiveIteratorIterator;
use SciPhp\Exception\InvalidArgumentException;
use SciPhp\NdArray;
use SciPhp\NumPhp as np;
use Webmozart\Assert\Assert;

/**
 * Shape methods for NdArray
 */
trait ShapeTrait
{
    /**
     * Flattens data array
     *
     * @link http://sciphp.org/ndarray.ravel Documentation
     * @api
     */
    final public function ravel(): NdArray
    {
        array_walk_recursive(
            $this->data,
            function($item) use (&$stack) {
            $stack[] = $item;
        });

        return np::ar($stack);
    }

    /**
     * Resize array
     *
     * @link http://sciphp.org/ndarray.resize Documentation
     * @api
     */
    final public function resize(): NdArray
    {
        $iterator = new RecursiveIteratorIterator(
            new RecursiveArrayIterator($this->data),
            RecursiveIteratorIterator::LEAVES_ONLY
        );

        $func = function(&$item) use (&$iterator) {
            $item = $this->iterate($iterator);
        };

        return np::nulls(np::parseArgs(func_get_args()))
            ->walk_recursive($func);
    }

    /**
     * Reshapes data
     *
     * @throws \InvalidArgumentException
     *  if shape parameter has a different size
     * @link http://sciphp.org/ndarray.reshape Documentation
     * @api
     */
    final public function reshape(): NdArray
    {
        $args = np::parseArgs(func_get_args());

        Assert::eq(array_product($args), $this->size);

        $data = $this->ravel()->data;

        while (($num = array_pop($args)) && count($args)) {
            $data = array_chunk($data, $num);
        }

        return np::ar($data);
    }

    /**
     * Gets the dimensions of the array
     *
     * @param  int|float|array $data Axis
     * @param  array $shape
     */
    final protected function getShape($data, array $shape): array
    {
        if (!is_array($data) || !count($data)) {
            return $shape;
        }

        $shape[] = count($data);

        return $this->getShape($data[0], $shape);
    }
}
