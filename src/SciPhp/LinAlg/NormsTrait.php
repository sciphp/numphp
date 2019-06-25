<?php

namespace SciPhp\LinAlg;

use SciPhp\NdArray;

/**
 * Norms methods
 */
trait NormsTrait
{
    /**
     * Matrix or vector norm.
     * 
     * @param  \SciPhp\NdArray $matrix
     * @return float|int
     * 
     * @link http://sciphp.org/linalg.norm
     * Documentation for norm()
     * 
     * @api
     */
    final public function norm(NdArray $matrix)
    {
        if ($matrix->ndim == 0) {
            return 0;
        }

        return sqrt(
            $matrix->power(2)->sum()
        );
    }
}
