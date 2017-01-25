<?php

namespace SciPhp\NumPhp;

use Webmozart\Assert\Assert;

trait LogarithmTrait
{
  /**
   * Natural logarithm, element-wise.
   * 
   * @param \SciPhp\NdArray|array|int|float $m
   * 
   * @param int|float $base
   * 
   * @return \SciPhp\NdArray|int|float
   * 
   * @link http://sciphp.org/numphp.log Documentation
   * 
   * @api
   */
  final public static function log($m, $base = M_E)
  {
    if (is_numeric($m))
    {
      Assert::greaterThan($base, 0);
      Assert::greaterThan($m, 0);

      return log($m, $base);
    }

    if (is_array($m))
    {
      $m = static::ar($m);
    }

    Assert::isInstanceof($m, 'SciPhp\NdArray');

    return $m->log($base);
  }

  /**
   * Base 10 logarithm, element-wise.
   * 
   * @param \SciPhp\NdArray|array|int|float $m
   * 
   * @return \SciPhp\NdArray|int|float
   * 
   * @link http://sciphp.org/numphp.log10 Documentation
   * 
   * @api
   */
  final public static function log10($m)
  {
    return self::log($m, 10);
  }

  /**
   * Base 2 logarithm, element-wise.
   * 
   * @param \SciPhp\NdArray|array|int|float $m
   * 
   * @return \SciPhp\NdArray|int|float
   * 
   * @link http://sciphp.org/numphp.log2 Documentation
   * 
   * @api
   */
  final public static function log2($m)
  {
    return self::log($m, 2);
  }
}
