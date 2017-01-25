<?php

namespace SciPhp\NdArray;

use SciPhp\NumPhp as np;
use Webmozart\Assert\Assert;

/**
 * Floating points methods
 */
trait FloatTrait
{
  /**
   * Returns element-wise true where signbit is set (less than zero).
   * 
   * @return \SciPhp\NdArray
   * 
   * @link http://sciphp.org/ndarray.signbit Documentation
   * 
   * @api
   */
  final public function signbit()
  {
    $func = function(&$element)
    {
      $element = $element < 0;
    };

    return $this->copy()->walk_recursive($func);
  }

  /**
   * Change the sign to that of given matrix, element-wise.
   * 
   * @param \SciPhp\NdArray|array|float|int $m
   * 
   * @return \SciPhp\NdArray
   * 
   * @link http://sciphp.org/ndarray.copysign Documentation
   * 
   * @api
   */
  final public function copysign($input)
  {
    if (is_numeric($input))
    {
      return $this->copy()->walk_recursive(
        function(&$item) use ($input) {
          if (np::signbit($item) !== np::signbit($input))
          {
            $item = -$item;
          }
        }
      );
    }

    return np::copysign($this, $input);
  }
}
