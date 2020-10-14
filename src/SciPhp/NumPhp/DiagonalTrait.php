<?php

namespace SciPhp\NumPhp;

use SciPhp\NdArray;
use SciPhp\Exception\Message;
use Webmozart\Assert\Assert;

/**
 * Diagonal methods for NumPhp
 */
trait DiagonalTrait
{
    /**
     * Sum along diagonals
     *
     * @param  \SciPhp\NdArray|array $m
     * @param  int $k offset
     * @return int|float|array
     * @throws \InvalidArgumentException
     * @link http://sciphp.org/numphp.trace Documentation
     * @todo Implement axis supports
     * @api
     */
    final public static function trace($m, $k = 0)
    {
      static::transform($m, true);

      return array_sum( static::diagonal($m, $k)->data );
    }

    /**
     * Construct an identity array
     *
     * @param  int $n
     * @throws \InvalidArgumentException
     * @link http://sciphp.org/numphp.identity Documentation
     * @todo implement Assert::natural()
     * @api
     */
    final public static function identity(int $n): NdArray
    {
      Assert::integer($n, Message::ONLY_POSITIVE_INT);
      Assert::greaterThan($n, 0, Message::ONLY_POSITIVE_INT);

      return self::eye($n, $n);
    }

    /**
     * Construct a diagonal array
     *
     * @param  int $rows Number of rows
     * @param  int $cols Number of columns
     * @param  int $k    Offset
     * @link http://sciphp.org/numphp.eye Documentation
     * @api
     */
    final public static function eye($rows, $cols = 0, $k = 0): NdArray
    {
        Assert::integer($rows);
        Assert::integer($cols);
        Assert::integer($k);
        Assert::greaterThan($rows, 0);
        Assert::greaterThanEq($cols, 0);

        if (0 === $cols) {
            $cols = $rows;
        }

        $diag = $rows > $cols
            ? array_fill(0, $cols, 1)
            : array_fill(0, $rows, 1);

        $col  = $k > 0 ?  $k : 0;

        return static::ar(
            array_map(
                self::itemFromDiagonal($col, $diag, $k),
                static::zeros($rows, $cols)->data
            )
        );
    }

    /**
     * Extract a diagonal or construct a diagonal array
     *
     * @param  array|\SciPhp\NdArray $m
     * @param  int $k Diagonal
     * @throws \SciPhp\Exception\InvalidArgumentException
     * @link http://sciphp.org/numphp.diag Documentation
     * @api
     */
    final public static function diag($m, int $k = 0): NdArray
    {
      static::transform($m, true);

      Assert::oneOf($m->ndim, [1, 2], 'Dimension must be 1 or 2. Given %s');

      if ($m->ndim == 1) {
        return self::fromDiagonal($m->data, $k);
      }

      return self::diagonal($m, $k);
    }

    /**
     * Extract a diagonal
     *
     * @param  \SciPhp\NdArray|array $m
     * @param  int $k Offset
     * @link http://sciphp.org/numphp.diagonal Documentation
     * @api
     */
    final public static function diagonal($m, $k = 0): NdArray
    {
      Assert::integer($k, 'Offset must be an integer. Given %s.');

      static::transform($m, true);

      Assert::oneOf($m->ndim, [1, 2]);

      $col  = $k > 0 ?  $k : 0;
      $line = $k < 0 ? -$k : 0;

      return static::ar(
        array_reduce(
          $m->data,
          function($diag) use (&$line, &$col, $m) {
            if (isset($m->data[$line], $m->data[$line][$col])) {
              $diag[] = $m->data[$line++][$col++];
            }
            return $diag;
          }
          , []
        )
      );
    }

    /**
     * Create a two-dimensional array with the flattened input
     * as a diagonal.
     *
     * @param  mixed $m An array to flatten
     * @param  int $k
     * @link http://sciphp.org/numphp.diagflat Documentation
     * @api
     */
    final public static function diagflat($m, $k = 0): NdArray
    {
      Assert::integer($k);

      static::transform($m, true);

      return self::fromDiagonal($m->copy()->ravel()->data, $k);
    }

    /**
     * Construct a diagonal array
     *
     * @param  array $diagonal
     * @param  int $k
     */
    final protected static function fromDiagonal(array $diagonal, $k): NdArray
    {
      $col    = $k > 0 ?  $k : 0;

      $height = $width = count($diagonal);
      $height+= $k < 0 ? -$k : 0;
      $width += $col;

      return static::ar(
        array_map(
          self::itemFromDiagonal($col, $diagonal, $k),
          static::zeros($height, $width)->data
        )
      );
    }

    /**
     * Fill a line among diagonal, offset and indexes
     *
     * @param  int   $col  Diagonal column index
     * @param  array $diagonal
     * @param  int   $k    Offset
     */
    final protected static function itemFromDiagonal($col, array $diagonal, $k, $line = 1): callable
    {
      return function($item) use (&$line, &$col, $diagonal, $k) {
        if ($k >= 0 && isset($item[$col], $diagonal[$col - $k])) {
          $item[$col] = $diagonal[$col - $k];
          $col++;
        } elseif ($k < 0) {
          if ($line++ > -$k && isset($item[$col], $diagonal[$col])) {
            $item[$col] = $diagonal[$col];
            $col++;
          }
        }

        return $item;
      };
    }
}
