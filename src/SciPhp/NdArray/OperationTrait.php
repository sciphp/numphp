<?php

namespace SciPhp\NdArray;

use SciPhp\NumPhp as np;

/**
 * Basic Math. operations for NdArray
 */
trait OperationTrait
{
  /**
   * Sum all elements.
   * 
   * @return int|float
   * 
   * @link http://sciphp.org/ndarray.sum Documentation
   * 
   * @api
   */
  final public function sum()
  {
    $func = function(array $array) use (&$func)
    {
      return isset($array[0]) && is_array($array[0])
              ? array_sum(array_map($func, $array))
              : array_sum($array);
    };

    return $func($this->data);
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
