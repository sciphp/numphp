<?php

namespace SciPhp\NdArray;

use SciPhp\NumPhp as np;
use Webmozart\Assert\Assert;

/**
 * Basic Math. operations for NdArray
 */
trait OperationTrait
{
    /**
     * Sum all elements.
     * 
     * @param  null|int $axis
     * @return int|float
     * 
     * @link http://sciphp.org/ndarray.sum Documentation
     * 
     * @api
     */
    final public function sum($axis = null)
    {
        $func = function(array $array) use (&$func)
        {
            return isset($array[0]) && is_array($array[0])
                            ? array_sum(array_map($func, $array))
                            : array_sum($array);
        };

        return is_null($axis)
            ? $func($this->data)
            : $this->axis($axis, $func);
    }

    /**
     * Integrate along the given axis using the composite trapezoidal rule.
     * 
     * @param array $options
     * 
     * @return int|float|array
     * 
     * @link http://sciphp.org/ndarray.trapz Documentation
     * 
     * @todo implement dx, x options parameters
     * 
     * @api
     */
    final public function trapz()
    {
        return np::trapz($this);
    }
}
