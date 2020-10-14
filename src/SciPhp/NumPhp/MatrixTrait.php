<?php

namespace SciPhp\NumPhp;

use SciPhp\NdArray;
use Webmozart\Assert\Assert;

trait MatrixTrait
{
    /**
     * Is given matrix a square matrix ?
     *
     * @param  \SciPhp\NdArray|array $m
     * @link http://sciphp.org/numphp.is_square Documentation
     * @since 0.3.0
     * @api
     */
    final public static function is_square($m): bool
    {
        static::transform($m, true);

        return $m->ndim == 2
            && $m->shape[0] == $m->shape[1];
    }

    /**
     * Numerical negative, element-wise.
     *
     * @param  \SciPhp\NdArray|array|int|float $m
     * @return \SciPhp\NdArray|int|float
     * @link http://sciphp.org/numphp.negative Documentation
     * @api
     */
    final public static function negative($m)
    {
        if (is_numeric($m)) {
            return -$m;
        }

        static::transform($m, true);

        return $m->dot(-1);
    }

    /**
     * Permute the dimensions of an array.
     *
     * @param  array|\SciPhp\NdArray $m
     * @param  array $axis
     * @todo   Implement axis permutation for ndim > 2
     * @throws \InvalidArgumentException
     * @link http://sciphp.org/numphp.transpose Documentation
     * @api
     */
    final public static function transpose($m): NdArray
    {
        static::transform($m, true);

        Assert::oneOf($m->ndim, [0, 1, 2],
            __METHOD__ . '() does not support dimension greater than 2'
        );

        if (in_array($m->ndim, [0, 1])) {
            return $m;
        }

        return static::ar(
            array_map(
                function() use ($m, &$row) {
                    return array_column($m->data, $row++);
                },
                $m->data[$row = 0]
            )
        );
    }
}
