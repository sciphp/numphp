<?php

namespace SciPhp\NdArray;

use SciPhp\NumPhp as np;

trait TriangleTrait
{
    /**
     * Lower triangle of an array
     * 
     * @param int $k Offset
     * 
     * @return \SciPhp\NdArray The lower triangle
     *
     * @link http://sciphp.org/ndarray.tril
     *    Documentation for tril()
     * 
     * @api
     */
    final public function tril($k = 0)
    {
        return np::tril($this, $k);
    }

    /**
     * Upper triangle of an array
     * 
     * @param int $k Offset
     * 
     * @return \SciPhp\NdArray The upper triangle
     *
     * @link http://sciphp.org/ndarray.triu
     *    Documentation for triu()
     * 
     * @api
     */
    final public function triu($k = 0)
    {
        return np::triu($this, $k);
    }
}
