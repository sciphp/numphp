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
 * @method \SciPhp\NdArray negative() Numerical negative, element-wise. {@link http://sciphp.org/ndarray.negative}
 * @method bool            is_square() Is current matrix a square matrix. {@link http://sciphp.org/ndarray.is_square}
 * @method \SciPhp\NdArray expm1() Calculate exp(x) - 1 for all elements in the array. {@link http://sciphp.org/ndarray.expm1}
 * @method \SciPhp\NdArray exp2() Calculate 2**p for all p in the input array. {@link http://sciphp.org/ndarray.exp2}
 * @method \SciPhp\NdArray power(float|int $exponent) Matrix elements raised to powers. {@link http://sciphp.org/ndarray.power}
 * @method \SciPhp\NdArray square() The element-wise square of the input. {@link http://sciphp.org/ndarray.square}
 * @method \SciPhp\NdArray sqrt() The non-negative square-root of an array, element-wise. {@link http://sciphp.org/ndarray.sqrt}
 * @method int|float|array trapz() Integrate along the given axis using the composite trapezoidal rule. {@link http://sciphp.org/ndarray.trapz}
 * @method int|float|\SciPhp\NdArray sum(null|int $axis, bool $keepdims) Sum all elements. {@link http://sciphp.org/ndarray.sum}
 * @method \SciPhp\NdArray subtract(\SciPhp\NdArray|array|float|int $input) Subtract input from matrix. {@link http://sciphp.org/ndarray.subtract}
 * @method \SciPhp\NdArray multiply(\SciPhp\NdArray|array|float|int $input) Multiply matrix by a given input, element-wise. {@link http://sciphp.org/ndarray.multiply}
 * @method \SciPhp\NdArray copysign(\SciPhp\NdArray|array|float|int $m) Change the sign to that of given matrix, element-wise. {@link http://sciphp.org/ndarray.copysign}
 * @method \SciPhp\NdArray cos() Cosine element-wise. {@link http://sciphp.org/ndarray.cos}
 * @method \SciPhp\NdArray sin() Trigonometric sine, element-wise. {@link http://sciphp.org/ndarray.sin}
 */
abstract class Decorator implements ArrayAccess, IndexInterface
{
    use ArithmeticTrait;
    use AttributeTrait;
    use BasicTrait;
    use IndexTrait;
    use ShapeTrait;
    use VisitorTrait;

    /**
     * Call a np function
     *
     * @return mixed
     */
    final public function __call(string $name, array $arguments = null)
    {
        return np::$name($this, ...$arguments);
    }
}
