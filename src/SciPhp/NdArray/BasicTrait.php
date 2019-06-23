<?php

namespace SciPhp\NdArray;

use SciPhp\NumPhp as np;

/**
 * Basics for NdArray
 */
trait BasicTrait
{
    /**
     * Create a copy
     * 
     * @return \SciPhp\NdArray
     * 
     * @link http://sciphp.org/ndarray.copy Documentation
     * 
     * @api
     */
    final public function copy()
    {
        return np::ar($this->data);
    }

    /**
     * Numerical negative, element-wise.
     * 
     * @return \SciPhp\NdArray
     * 
     * @link http://sciphp.org/ndarray.negative Documentation
     * 
     * @api
     */
    final public function negative()
    {
        return $this->dot(-1);
    }
}
