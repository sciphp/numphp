<?php

namespace SciPhp;

use SciPhp\NdArray\Formatter;
use SciPhp\NdArray\Decorator;
use SciPhp\NumPhp as np;

/**
 * Base array
 *
 * @link http://sciphp.org/ref.ndarray
 *
 * @property NdArray $T     Permute the dimensions of an array.
 * @property int     $ndim  Number of dimensions of an array.
 * @property int     $size  Number of elements of an array.
 * @property array   $shape Tuple of array dimensions.
 * @property array   $data  Access data as a PHP array.
 */
final class NdArray extends Decorator
{
    /**
     * Constructor
     *
     * @param  array $data
     * @param  string $identifier A NdArray identifier
     */
    final public function __construct(array $data, string $identifier = null)
    {
        $this->data = $data;
    }

    /**
     * Pretty printer
     *
     * @return string
     */
    final public function __toString()
    {
        return (new Formatter($this))->toString();
    }
}
