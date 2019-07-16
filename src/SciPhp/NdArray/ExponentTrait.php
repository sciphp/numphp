<?php

namespace SciPhp\NdArray;

use Webmozart\Assert\Assert;
use SciPhp\Exception\Message;

/**
 * Exponent methods
 */
trait ExponentTrait
{
    /**
     * Calculate the exponential of all elements in the input array.
     * 
     * @return \SciPhp\NdArray
     * 
     * @link http://sciphp.org/ndarray.exp Documentation
     * 
     * @api
     */
    final public function exp()
    {
        $func = function(&$element)
        {
            $element = exp($element);
        };

        return $this->copy()->walk_recursive($func);
    }

    /**
     * Calculate exp(x) - 1 for all elements in the array.
     * 
     * @return \SciPhp\NdArray
     * 
     * @link http://sciphp.org/ndarray.expm1 Documentation
     * 
     * @api
     */
    final public function expm1()
    {
        $func = function(&$element)
        {
            $element = expm1($element);
        };

        return $this->copy()->walk_recursive($func);
    }

    /**
     * Calculate 2**p for all p in the input array.
     * 
     * @return \SciPhp\NdArray
     * 
     * @link http://sciphp.org/ndarray.exp2 Documentation
     * 
     * @api
     */
    final public function exp2()
    {
        $func = function(&$element)
        {
            $element = 2 ** $element;
        };

        return $this->copy()->walk_recursive($func);
    }

    /**
     * Matrix elements raised to powers.
     * 
     * @param  float|int $exponent
     * @return \SciPhp\NdArray
     * 
     * @link http://sciphp.org/ndarray.power Documentation
     * 
	 * @since 0.3.0 
     * @api
     */
    final public function power($exponent)
    {
        $func = function(&$element) use ($exponent)
        {
            $element = $element ** $exponent;
        };

        return $this->copy()->walk_recursive($func);
    }

    /**
     * The element-wise square of the input.
     * 
     * @return \SciPhp\NdArray
     * @link   http://sciphp.org/ndarray.square Documentation
	 * @since  0.3.0 
     * @api
     */
    final public function square()
    {
        return $this->power(2);
    }

    /**
     * The non-negative square-root of an array, element-wise.
     * 
     * @return \SciPhp\NdArray
     * @link   http://sciphp.org/ndarray.sqrt Documentation
	 * @since  0.3.0 
     * @api
     */
    final public function sqrt()
    {
        $func = function(&$element)
        {
            Assert::greaterThanEq(
                $element, 
                0, 
                Message::ONLY_POSITIVE_NUMBER
            );

            $element = sqrt($element);
        };

        return $this->copy()->walk_recursive($func);
    }
}
