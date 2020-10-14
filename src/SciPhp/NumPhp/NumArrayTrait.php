<?php

namespace SciPhp\NumPhp;

use SciPhp\Exception\Message;
use Webmozart\Assert\Assert;
use SciPhp\NdArray;

trait NumArrayTrait
{
    /**
     * Creates a NdArray with zero as default value
     *
     * @link http://sciphp.org/numphp.zeros
     *    Documentation for zeros()
     *
     * @api
     */
    final public static function zeros(): NdArray
    {
        return self::full(
            static::parseArgs(func_get_args()), 0
        );
    }

    /**
     * Creates a NdArray with one as default value
     *
     * @link http://sciphp.org/numphp.ones
     *    Documentation for ones()
     *
     * @api
     */
    final public static function ones(): NdArray
    {
        return self::full(
            static::parseArgs(func_get_args()), 1
        );
    }

    /**
     * Creates a NdArray with null as default value
     * 'empty' can not be used in PHP
     *
     * @link http://sciphp.org/numphp.nulls
     *    Documentation for nulls()
     *
     * @api
     */
    final public static function nulls(): NdArray
    {
        return self::full(
            static::parseArgs(func_get_args()), null
        );
    }

    /**
     * Creates a NdArray with a default value
     *
     * @param  array $shape
     * @param  mixed $value
     *
     * @link http://sciphp.org/numphp.full
     *    Documentation for full()
     *
     * @api
     */
    final public static function full(array $shape, $value): NdArray
    {
        Assert::allInteger($shape);
        Assert::allGreaterThan($shape, 0);

        return static::ar(
            self::createArray($shape, $value)
        );
    }

    /**
     * Construct a n-dim array with a default value
     *
     * @param  array $params
     * @param  mixed $value
     * @return mixed|array
     */
    final protected static function createArray(array $params, $value)
    {
        return isset($params[0])
            ? array_fill(
                    0,
                    array_shift($params),
                    self::createArray($params, $value)
            ) : $value;
    }

    /**
     * Construct a new array of nulls with the same shape and type
     * as a given array.
     *
     * @param  array|\SciPhp\NdArray $matrix
     *
     * @link http://sciphp.org/numphp.nulls_like
     *    Documentation for nulls_like()
     *
     * @api
     */
    final public static function nulls_like($matrix): NdArray
    {
        return self::full_like($matrix, null);
    }

    /**
     * Construct a new array of zeros with the same shape and type
     * as a given array.
     *
     * @param  array|\SciPhp\NdArray $matrix
     *
     * @link http://sciphp.org/numphp.zeros_like
     *    Documentation for zeros_like()
     *
     * @api
     */
    final public static function zeros_like($matrix): NdArray
    {
        return self::full_like($matrix, 0);
    }

    /**
     * Construct a new array of ones with the same shape and type
     * as a given array.
     *
     * @param  array|\SciPhp\NdArray $matrix
     *
     * @link http://sciphp.org/numphp.ones_like
     *    Documentation for ones_like()
     *
     * @api
     */
    final public static function ones_like($matrix): NdArray
    {
        return self::full_like($matrix, 1);
    }

    /**
     * Construct a new array with the same shape and type as a given array,
     * filled with a given value
     *
     * @param  array|\SciPhp\NdArray $matrix
     *
     * @link http://sciphp.org/numphp.full_like
     *    Documentation for full_like()
     *
     * @api
     */
    final public static function full_like($matrix, $value = null): NdArray
    {
        if (is_array($matrix)) {
            $matrix = static::ar($matrix);
        }

        Assert::isInstanceOf($matrix, '\SciPhp\NdArray');

        return self::full($matrix->shape, $value);
    }

    /**
     * Broadcast an array to a new shape.
     *
     * @param  array|\SciPhp\NdArray $matrix
     * @param  array $shape
     *
     * @link http://sciphp.org/numphp.broadcast_to
     *    Documentation for broadcast_to()
     *
     * @since 0.3.0
     * @api
     */
    final public static function broadcast_to($matrix, array $shape): NdArray
    {
        static::transform($matrix, true);

        // Is broadcast allowed?
        self::can_broadcast_to($matrix, $shape);

        // 1 dim -> 2 dim
        if ($matrix->ndim == 1) {
            return $matrix->resize($shape);
        }

        $m = self::zeros($shape);

        $row = 0;
        $func = function ($value) use (&$m, &$row) {
            $m["$row, :"] = $value;
            $row++;
        };

        $matrix->walk_recursive($func);

        return $m;
    }

    /**
     * Checks that an array can be broadcast to a given shape
     *
     * @param  NdArray $matrix
     * @param  array   $shape
     * @throws \InvalidArgumentException when broadcast cannot be done
     */
    private static function can_broadcast_to(NdArray $m, array $shape): void
    {
        if (count($shape) > 2) {
            throw new \InvalidArgumentException(
                Message::ARRAYS_BROADCAST_NDIM2_ONLY
            );
        }

        if ($m->ndim > 2) {
            throw new \InvalidArgumentException(
                Message::ARRAYS_BROADCAST_NDIM2_ONLY
            );
        }

        $shape_m = $m->shape;
        $m_index = $m->ndim;

        for ($i = count($shape) - 1; $i >= 0; $i--) {
            $m_index--;
            if (!isset($shape_m[$m_index])) {
                continue;
            } elseif ($shape[$i] == $shape_m[$m_index]) {
                continue;
            } elseif ($shape_m[$m_index] == 1) {
                continue;
            }

            $message = sprintf(
                Message::ARRAYS_BROADCAST_IMPOSSIBLE,
                trim(static::ar($m->shape)),
                trim(static::ar($shape))
            );

            throw new \InvalidArgumentException($message);
        }
    }
}
