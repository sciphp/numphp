<?php

declare(strict_types=1);

namespace SciPhp;

use SciPhp\NdArray\Decorator;
use SciPhp\NdArray\Formatter;

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
    public function __construct(array $data, ?string $identifier = null)
    {
        $this->data = $data;
    }

    /**
     * Pretty printer
     */
    public function __toString(): string
    {
        return (new Formatter($this))->toString();
    }
}
