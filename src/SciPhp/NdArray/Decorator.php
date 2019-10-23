<?php

namespace SciPhp\NdArray;

use ArrayAccess;
use SciPhp\NumPhp as np;

/**
 * Multiple inheritance for NdArray
 * 
 * @method \SciPhp\NdArray reciprocal() Return the reciprocal of the argument, element-wise. {@link http://sciphp.org/ndarray.reciprocal}
 * @method int|float|array trace(int $k = 0) Sum along diagonals {@link http://sciphp.org/ndarray.trace}.
 * @method \SciPhp\NdArray tril(int $k = 0) Lower triangle of an array {@link http://sciphp.org/ndarray.tril}
 * @method \SciPhp\NdArray triu(int $k = 0) Upper triangle of an array {@link http://sciphp.org/ndarray.triu}
 * @method \SciPhp\NdArray vander(int $num = null) Generate a Vandermonde matrix. {@link http://sciphp.org/ndarray.vander}
 * @method \SciPhp\NdArray signbit() Returns element-wise true where signbit is set (less than zero). {@link http://sciphp.org/ndarray.signbit}
 * @method \SciPhp\NdArray log(int|float $base = M_E) Natural logarithm, element-wise. {@link http://sciphp.org/ndarray.log}
 * @method \SciPhp\NdArray log10() Base-10 logarithm, element-wise. {@link http://sciphp.org/ndarray.log10}
 * @method \SciPhp\NdArray log2() Base-2 logarithm, element-wise. {@link http://sciphp.org/ndarray.log2}
 */
abstract class Decorator implements ArrayAccess, IndexInterface
{
    use ArithmeticTrait;
    use AttributeTrait;
    use BasicTrait;
    use ExponentTrait;
    use FloatTrait;
    use IndexTrait;
    use OperationTrait;
    use ShapeTrait;
    use VisitorTrait;

    /**
     * Call a np function
     * 
     * @param  string $name
     * @param  array  $arguments
     * @return mixed
     */
    final public function __call($name, array $arguments = null)
    {
        return np::$name($this, ...$arguments);
    }
}
