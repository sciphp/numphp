<?php

namespace SciPhp;

use SciPhp\NumPhp\Decorator;
use Webmozart\Assert\Assert;

/**
 * Entry point for np calls.
 */
final class NumPhp extends Decorator
{
  /**
   * Construct a n-dimensional array
   * 
   * @link http://sciphp.org/numphp.ar
   *  Documentation of NumPhp::ar().
   * 
   * @api
   * 
   * @param array $data
   * 
   * @return \SciPhp\NdArray
   */
  final public static function ar(array $data)
  {
    return new NdArray($data);
  }

  /**
   * Parse args as a tuple or an array
   * 
   * @param array|array[] $args
   * 
   * @return array
   */
  final public static function parseArgs(array $args)
  {
    if (isset($args[0]) && is_array($args[0]))
    {
      Assert::oneOf(
        self::ar($args[0])->ndim,
        [0, 1],
        'Argument must be an array or a tuple-like'
      );

      Assert::allNumeric($args[0]);

      return $args[0];
    }

    Assert::allNumeric($args);

    return $args;
  }
}
