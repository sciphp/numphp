<?php

namespace SciPhp\NdArray;

use SciPhp\NumPhp as np;

trait VanderTrait
{
  /**
   * Generate a Vandermonde matrix.
   * 
   * @param int $num Number of columns for the output.
   * 
   * @return \SciPhp\NdArray A Vandermonde matrix
   * 
   * @throws \InvalidArgumentException
   *
   * @link http://sciphp.org/ndarray.vander
   *  Documentation for vander()
   * 
   * @api
   */
  final public function vander($num = null)
  {
    return np::vander($this, $num);
  }
}
