<?php

namespace SciPhp\NumPhp;

use Webmozart\Assert\Assert;

trait OperationTrait
{
  /**
   * Sum all elements.
   * 
   * @param \SciPhp\NdArray|array|int|float $m
   * 
   * @return int|float
   * 
   * @link http://sciphp.org/numphp.sum Documentation
   * 
   * @api
   */
  final public static function sum($m)
  {
    if (is_numeric($m))
    {
      return $m;
    }

    if (is_array($m))
    {
      $m = static::ar($m);
    }

    Assert::isInstanceof($m, 'SciPhp\NdArray');

    return $m->sum();
  }

  /**
   * Integrate along the given axis using the composite trapezoidal rule.
   * 
   * @param \SciPhp\NdArray|array $m
   * 
   * @param array $options
   * 
   * @return int|float|array
   * 
   * @link http://sciphp.org/numphp.trapz Documentation
   * 
   * @todo implement dx, x options parameters
   * 
   * @api
   */
  final public static function trapz($m, array $options = [])
  {
    if (is_array($m))
    {
      $m = static::ar($m);
    }

    Assert::isInstanceof($m, 'SciPhp\NdArray');
    Assert::eq(1, $m->ndim);

    // dx = 1
    $func = function($value, $key) use (& $prev) {
      if ($key === 0)
      {
        $prev = $value;
        
        return 0;
      }
      
      $sum = ($value + $prev) / 2;
      
      $prev = $value;
      
      return $sum;
    };
    
    return array_sum(
      array_map(
        $func,
        $m->data,
        array_keys($m->data)
      )
    );
  }
}