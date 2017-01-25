<?php

namespace SciPhp\NdArray;

use Webmozart\Assert\Assert;

/**
 * Logarithm operations for NdArray
 */
trait LogarithmTrait
{
  /**
   * Natural logarithm, element-wise.
   * 
   * @param int|float $base
   * 
   * @return \SciPhp\NdArray
   * 
   * @link http://sciphp.org/ndarray.log Documentation
   * 
   * @api
   */
  final public function log($base = M_E)
  {
    Assert::greaterThan($base, 0);

    $func = function(&$element) use ($base)
    {
      Assert::greaterThan($element, 0);

      $element = log($element, $base);
    };

    return $this->copy()->walk_recursive($func);
  }

  /**
   * Base-10 logarithm, element-wise.
   * 
   * @return \SciPhp\NdArray
   * 
   * @link http://sciphp.org/ndarray.log10 Documentation
   * 
   * @api
   */
  final public function log10()
  {
    return $this->log(10);
  }

  /**
   * Base-2 logarithm, element-wise.
   * 
   * @return \SciPhp\NdArray
   * 
   * @link http://sciphp.org/ndarray.log2 Documentation
   * 
   * @api
   */
  final public function log2()
  {
    return $this->log(2);
  }
}
