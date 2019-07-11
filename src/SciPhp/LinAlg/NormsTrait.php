<?php

namespace SciPhp\LinAlg;

use SciPhp\NumPhp as np;

/**
 * Norms methods
 */
trait NormsTrait
{
    /**
     * Matrix or vector norm.
     * 
     * @param  \SciPhp\NdArray|array $matrix
     * @return float|int
     * 
     * @link http://sciphp.org/linalg.norm
     * Documentation for norm()
     * 
     * @since 0.3.0
     * @api
     */
    final public function norm($matrix)
    {
        np::transform($matrix, true);

        if ($matrix->ndim == 0) {
            return 0;
        }

        return sqrt(
            $matrix->power(2)->sum()
        );
    }
}
