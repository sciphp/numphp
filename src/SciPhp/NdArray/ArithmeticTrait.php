<?php

namespace SciPhp\NdArray;

use RecursiveArrayIterator;
use RecursiveIteratorIterator;
use SciPhp\Exception\Message;
use SciPhp\NumPhp as np;
use Webmozart\Assert\Assert;

/**
 * Arithmetic methods
 */
trait ArithmeticTrait
{
    /**
     * Return the reciprocal of the argument, element-wise.
     * 
     * @return \SciPhp\NdArray
     *
     * @link http://sciphp.org/ndarray.reciprocal
     *    Documentation for reciprocal() method
     * 
     * @api
     */
    final public function reciprocal()
    {
        return np::reciprocal($this);
    }

    /**
     * Divide matrix by a given input, element-wise
     * 
     * @param  \SciPhp\NdArray|array|float|int $input
     * @return \SciPhp\NdArray
     *
     * @link http://sciphp.org/ndarray.divide
     *    Documentation for divide() method
     * 
     * @api
     */
    final public function divide($input)
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
     * Multiply matrix by a given input, element-wise
     * 
     * @param  \SciPhp\NdArray|array|float|int $input
     * @return \SciPhp\NdArray
     *
     * @link http://sciphp.org/ndarray.multiply
     *    Documentation for multiply() method
     * 
     * @api
     */
    final public function multiply($input)
    {
        if (is_numeric($input)) {
            return $this->dot($input);
        }

        return np::multiply($this, $input);
    }

    /**
     * Subtract input from matrix
     * 
     * @param  \SciPhp\NdArray|array|float|int $input
     * @return \SciPhp\NdArray
     *
     * @link http://sciphp.org/ndarray.subtract
     *    Documentation for subtract() method
     * 
     * @api
     */
    final public function subtract($input)
    {
        return $this->negative()->add($input)->negative();
    }

    /**
     * Dot matrix with an input
     * 
     * @param  \SciPhp\NdArray|array|float|int $input
     * @return \SciPhp\NdArray
     *
     * @link http://sciphp.org/ndarray.dot
     *    Documentation for dot() method
     * 
     * @api
     */
    final public function dot($input)
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
     * @return \SciPhp\NdArray
     * 
     * @link http://sciphp.org/ndarray.add
     *    Documentation for add() method
     * 
     * @api
     */
    final public function add($input)
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
