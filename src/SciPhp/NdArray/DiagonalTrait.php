<?php

namespace SciPhp\NdArray;

use SciPhp\NumPhp as np;

/**
 * Diagonal methods for NdArray
 */
trait DiagonalTrait
{
  /**
   * Sum along diagonals
   * 
   * @param int $k offset
   * 
   * @return int|float|array
   * 
   * @throws \InvalidArgumentException
   * 
   * @link http://sciphp.org/ndarray.trace
   *  Documentation for trace()
   * 
   * @todo Implement axis supports
   * 
   * @api
   */
  final public function trace($k = 0)
  {
    return np::trace($this, $k);
  }
}
