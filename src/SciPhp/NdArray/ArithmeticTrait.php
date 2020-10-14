<?php

namespace SciPhp\NdArray;

use RecursiveArrayIterator;
use RecursiveIteratorIterator;
use SciPhp\Exception\Message;
use SciPhp\NdArray;
use SciPhp\NumPhp as np;
use Webmozart\Assert\Assert;

/**
 * Arithmetic methods
 */
trait ArithmeticTrait
{
    /**
     * Divide matrix by a given input, element-wise
     *
     * @param  \SciPhp\NdArray|array|float|int $input
     *
     * @link http://sciphp.org/ndarray.divide
     *    Documentation for divide() method
     *
     * @api
     */
    final public function divide($input): NdArray
    {
        if (is_numeric($input))
        {
            Assert::notEq(0, $input);

            return $this->copy()->walk_recursive(
                function(&$item) use ($input) {
                    $item /= $input;
                }
            );
        }

        return np::divide($this, $input);
    }

    /**
     * Dot matrix with an input
     *
     * @param  \SciPhp\NdArray|array|float|int $input
     *
     * @link http://sciphp.org/ndarray.dot
     *    Documentation for dot() method
     *
     * @api
     */
    final public function dot($input): NdArray
    {
        if (is_numeric($input))
        {
            return $this->copy()->walk_recursive(
                function(&$item) use ($input) {
                    $item *= $input;
                }
            );
        }

        return np::dot($this, $input);
    }

    /**
     * Add a matrix or a number
     *
     * @param  NdArray|array|float|int $value
     *
     * @link http://sciphp.org/ndarray.add
     *    Documentation for add() method
     *
     * @api
     */
    final public function add($input): NdArray
    {
        if (is_numeric($input))
        {
            return $this->walk_recursive(
                function(&$item) use ($input) {
                    $item += $input;
                }
            );
        }

        if (is_array($input))
        {
            $input = np::ar($input);
        }

        Assert::isInstanceof($input, 'SciPhp\NdArray');
        Assert::oneOf($this->ndim, [1, 2]);
        Assert::oneOf($input->ndim, [1, 2]);

        // vector + vector
        if ($this->ndim == 1 && $this->ndim == $input->ndim)
        {
            Assert::eq($this->shape, $input->shape, Message::MAT_NOT_ALIGNED);
        }
        // vector + array
        elseif ($this->ndim == 1 && $input->ndim == 2)
        {
            Assert::eq($this->shape[0], $input->shape[1], Message::MAT_NOT_ALIGNED);
        }
        // array + vector
        elseif ($input->ndim == 1 && $this->ndim == 2)
        {
            Assert::eq($this->shape[1], $input->shape[0], Message::MAT_NOT_ALIGNED);
        }
        // array + array
        else
        {
            Assert::eq($this->shape, $input->shape, Message::MAT_NOT_ALIGNED);
        }

        $iterator = new RecursiveIteratorIterator(
            new RecursiveArrayIterator(
                $this->ndim >= $input->ndim
                    ? $input->data
                    : $this->data
            ),
            RecursiveIteratorIterator::LEAVES_ONLY
        );

        $func = function(&$item) use (&$iterator) {
            $item += $this->iterate($iterator);
        };

        return $this->ndim >= $input->ndim
            ? $this->copy()->walk_recursive($func)
            : $input->copy()->walk_recursive($func);
    }
}
