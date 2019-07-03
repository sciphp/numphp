<?php

namespace SciPhp\NumPhp;

use Webmozart\Assert\Assert;

trait NumArrayTrait
{
    /**
     * Creates a NdArray with zero as default value
     * 
     * @return \SciPhp\NdArray
     * 
     * @link http://sciphp.org/numphp.zeros
     *    Documentation for zeros()
     * 
     * @api
     */
    final public static function zeros()
    {
        return self::full(
            static::parseArgs(func_get_args()), 0
        );
    }

    /**
     * Creates a NdArray with one as default value
     * 
     * @return \SciPhp\NdArray
     * 
     * @link http://sciphp.org/numphp.ones
     *    Documentation for ones()
     * 
     * @api
     */
    final public static function ones()
    {
        return self::full(
            static::parseArgs(func_get_args()), 1
        );
    }

    /**
     * Creates a NdArray with null as default value
     * 'empty' can not be used in PHP
     * 
     * @return \SciPhp\NdArray
     * 
     * @link http://sciphp.org/numphp.nulls
     *    Documentation for nulls()
     * 
     * @api
     */
    final public static function nulls()
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
     * @return \SciPhp\NdArray
     * 
     * @link http://sciphp.org/numphp.full
     *    Documentation for full()
     * 
     * @api
     */
    final public static function full(array $shape, $value)
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
     * @return \SciPhp\NdArray
     * 
     * @link http://sciphp.org/numphp.nulls_like
     *    Documentation for nulls_like()
     * 
     * @api
     */
    final public static function nulls_like($matrix)
    {
        return self::full_like($matrix, null);
    }

    /**
     * Construct a new array of zeros with the same shape and type 
     * as a given array.
     * 
     * @param  array|\SciPhp\NdArray $matrix
     * @return \SciPhp\NdArray
     * 
     * @link http://sciphp.org/numphp.zeros_like
     *    Documentation for zeros_like()
     * 
     * @api
     */
    final public static function zeros_like($matrix)
    {
        return self::full_like($matrix, 0);
    }

    /**
     * Construct a new array of ones with the same shape and type 
     * as a given array.
     * 
     * @param  array|\SciPhp\NdArray $matrix
     * @return \SciPhp\NdArray
     * 
     * @link http://sciphp.org/numphp.ones_like
     *    Documentation for ones_like()
     * 
     * @api
     */
    final public static function ones_like($matrix)
    {
        return self::full_like($matrix, 1);
    }

    /**
     * Construct a new array with the same shape and type as a given array,
     * filled with a given value 
     * 
     * @param  array|\SciPhp\NdArray $matrix
     * @return \SciPhp\NdArray
     * 
     * @link http://sciphp.org/numphp.full_like
     *    Documentation for full_like()
     * 
     * @api
     */
    final public static function full_like($matrix, $value = null)
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
     * @return \SciPhp\NdArray
     * 
     * @link http://sciphp.org/numphp.broadcast_to
     *    Documentation for broadcast_to()
     * 
     * @api
     */
    final public static function broadcast_to($matrix, array $shape)
    {
        static::transform($matrix, true);

        $m = self::zeros($shape);

        $row = 0;
        $func = function ($value) use (&$m, &$row) {
            $m["$row, :"] = $value;
            $row++;
        };

        $matrix->walk_recursive($func);

        return $m;
    }
}
