<?php

namespace SciPhp\NumPhp;

use Webmozart\Assert\Assert;

trait MatrixTrait
{
  /**
   * Numerical negative, element-wise.
   * 
   * @param  \SciPhp\NdArray|array|int|float $m
   * @return \SciPhp\NdArray
   * @link http://sciphp.org/numphp.negative Documentation
   * @api
   */
  final public static function negative($m)
  {
    if (is_numeric($m))
    {
      return -$m;
    }

    static::transform($m);

    Assert::isInstanceof($m, 'SciPhp\NdArray');

    return $m->negative();
  }

  /**
   * Permute the dimensions of an array.
   * 
   * @param  array|\SciPhp\NdArray $m
   * @param  array $axis
   * @todo   Implement axis permutation for ndim > 2
   * @return \SciPhp\NdArray
   * @throws \InvalidArgumentException
   * @link http://sciphp.org/numphp.transpose Documentation
   * @api
   */
  final public static function transpose($m, array $axis = null)
  {
    static::transform($m);

    Assert::isInstanceof($m, 'SciPhp\NdArray');
    Assert::oneOf($m->ndim, [0, 1, 2],
      __METHOD__ . '() does not support dimension greater than 2'
    );

    if (in_array($m->ndim, [0, 1]))
    {
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
