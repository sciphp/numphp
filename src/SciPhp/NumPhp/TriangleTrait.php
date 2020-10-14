<?php

namespace SciPhp\NumPhp;

use SciPhp\NdArray;
use Webmozart\Assert\Assert;

trait TriangleTrait
{
  /**
   * Upper triangle of an array
   *
   * @param  \SciPhp\NdArray|array $m
   * @param  int $k Offset
   * @link http://sciphp.org/numphp.triu Documentation
   * @api
   */
  final public static function triu($m, $k = 0): NdArray
  {
    Assert::integer($k);

    static::transform($m, true);

    if (!isset($m->data[0])) {
      return static::ar([[]]);
    }

    $col  = $k > 0 ?  $k : 0;
    $count = count($m->data[0]);

    return static::ar(
      array_map(
        self::itemTriu($col, $k, $count),
        $m->data
      )
    );
  }

  /**
   * Fill zeros from first item to a position
   *
   * @param  int $col  Stop column position
   * @param  int $k    Offset
   * @param  int $count Max column position
   * @param  int $line Start line for negative offsets
   * @return array
   */
  final protected static function itemTriu($col, $k, $count, $line = 1): callable
  {
    return function($item) use (&$col, &$line, $k, $count) {
      if ($k >= 0 || ($k < 0 && $line++ > -$k)) {
        $num = $col++;
      }

      if (isset($num)) {
        return array_replace(
          $item,
          array_fill(0, min($num, $count), 0)
        );
      }

      return $item;
    };
  }

  /**
   * Lower triangle of an array
   *
   * @param  \SciPhp\NdArray|array $m
   * @param  int $k Offset
   * @link http://sciphp.org/numphp.tril Documentation
   * @api
   */
  final public static function tril($m, $k = 0): NdArray
  {
    Assert::integer($k);

    static::transform($m, true);

    if (!isset($m->data[0])) {
      return static::ar([[]]);
    }

    $col  = $k > 0 ?  $k : 0;
    $count = count($m->data[0]);

    return static::ar(
      array_map(
        self::itemTril($col, $k, $count),
        $m->data
      )
    );
  }

  /**
   * Fill zeros from a position to the end of the array
   *
   * @param  int $col  Start column position
   * @param  int $k    Offset
   * @param  int $count Last column position
   * @param  int $line Start line for negative offsets
   */
  final protected static function itemTril($col, $k, $count, $line = 1): callable
  {
    return function($item) use (&$col, &$line, $k, $count) {
      if ($k >= 0) {
        $num = $count - ++$col;
      } else {
        $num = $line++ > -$k
          ? $count - ++$col
          : $count;
      }

      if ($num > 0) {
        return array_replace(
          $item,
          array_fill($col, $num, 0)
        );
      }

      return $item;
    };
  }

  /**
   * Construct an array with ones at and below the given diagonal
   * and zeros elsewhere
   *
   * @param  int $rows Number of rows
   * @param  int $cols Number of columns
   * @param  int $k    Offset
   * @link http://sciphp.org/numphp.tri Documentation
   * @api
   */
  final public static function tri($rows, $cols = null, $k = 0): NdArray
  {
    Assert::integer($rows);
    Assert::greaterThan($rows, 0);

    if (null === $cols) {
      $cols = $rows;
    }

    Assert::integer($cols);
    Assert::greaterThan($cols, 0);

    Assert::integer($k);

    $col  = $k > 0 ?  $k : 0;

    return static::ar(
      array_map(
        self::itemTri($col, $k, $cols),
        static::zeros($rows, $cols)->data
      )
    );
  }

  /**
   * Return a closure that fill a line item with ones
   *
   * @param  int $col     Position until which filling is done
   * @param  int $k       Offset
   * @param  int $maxCols Max position to fill
   * @param  int $line    Start at this line if offset is negative
   */
  final protected static function itemTri($col, $k, $maxCols, $line = 1): callable
  {
    return function($item) use (&$line, &$col, $k, $maxCols) {
      if ($k >= 0 || ($k < 0 && $line++ > -$k)) {
        $num = min(++$col, $maxCols);

        return array_replace(
          $item,
          array_fill(0, $num, 1)
        );
      }

      return $item;
    };
  }
}
