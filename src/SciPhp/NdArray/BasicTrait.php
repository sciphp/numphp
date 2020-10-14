<?php

namespace SciPhp\NdArray;

use SciPhp\NdArray;
use SciPhp\NumPhp as np;

/**
 * Basics for NdArray
 */
trait BasicTrait
{
    /**
     * Create a copy
     *
     * @link http://sciphp.org/ndarray.copy Documentation
     * @api
     */
    final public function copy(): NdArray
    {
        return np::ar($this->data);
    }
}
