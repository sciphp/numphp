<?php

namespace SciPhp\NumPhp;

use SciPhp\NdArray;
use Webmozart\Assert\Assert;

trait RangeTrait
{
    /**
     * Creates a NdArray with a range of values
     *
     * @param int|float $start
     * @param int|float $end
     * @param int|float $step
     *
     * @link http://sciphp.org/numphp.arange
     *    Documentation for arange()
     *
     * @api
     */
    final public static function arange($start, $end = null, $step = 1): NdArray
    {
        Assert::numeric($start);

        if (null === $end)
        {
            $end     = $start > 0 ? $start : 0;
            $start = $start > 0 ? 0 : $start;
        }

        Assert::numeric($end);
        Assert::notEq($step, 0);
        Assert::numeric($step);

        if ($end < $start && $step == 1)
        {
            $step = -1;
        }

        if ($start == $end)
        {
            return static::ar([]);
        }

        if ($step < 0)
        {
            Assert::greaterThan($start, $end);
            if ($start + $step < $end)
            {
                return static::ar([$start]);
            }
            $end = $end - $step;
        }
        else
        {
            Assert::greaterThan($end, $start);

            if ($end < $start + $step)
            {
                return static::ar([$start]);
            }
            $end = $end - $step;
        }

        return static::ar(
                range($start, $end, $step)
        );
    }

    /**
     * Creates a n-dim array with a range of values
     *
     * @param int|float $start
     * @param int|float $end
     * @param int $num
     * @param bool $endpoint
     * @param bool $retstep
     * @return \SciPhp\NdArray|[\NumPhp\NdArray, $retstep]
     *
     * @link http://sciphp.org/numphp.linspace
     *    Documentation for linspace()
     *
     * @api
     */
    final public static function linspace($start, $end, $num = 50, $endpoint = true, $retstep = false)
    {
        Assert::numeric($start);
        Assert::numeric($end);
        Assert::integer($num);
        Assert::greaterThanEq($num, 0, '$num must be non-negative. "%s" given.');

        $step = $end - $start;

        if ($num == 0) {
            return !$retstep
                ? static::ar([])
                : [static::ar([]), null];
        } elseif ($endpoint && $num == 1) {
            $start = $end;
        } elseif (!$endpoint && $num == 1) {
            $end = $start;
        } elseif ($endpoint) {
            $step = ($end - $start) / ($num - 1);
            $end = $start + $num * $step;
        } elseif (!$endpoint) {
            $step = ($end - $start) / $num;

            // workaround because sometimes when $step is a float
            // $start + $num * $step > $stop
            $end = $start + $num * $step;
        }

        // range with same number
        if ($start == $end) {
            return !$retstep
                ? static::ar(array_fill(0, $num, $start))
                : [static::ar(array_fill(0, $num, $start)), $step];
        }

        return !$retstep
            ? static::ar(
                    array_slice(
                        range($start, $end, $step), 0, $num
                    )
                )
            : [ static::ar(
                        array_slice(
                            range($start, $end, $step), 0, $num
                        )
                    ), $step];
    }

    /**
     * Creates a NdArray with a range of values
     *
     * @param int|float $start
     * @param int|float $end
     * @param int $num
     * @param bool $endpoint
     * @param float $base
     *
     * @link http://sciphp.org/numphp.logspace
     *    Documentation for logspace()
     *
     * @api
     */
    final public static function logspace($start, $end, $num = 50, $endpoint = true, $base = 10): NdArray
    {
        $func = function(&$item) use ($base) {
            $item = pow($base, $item);
        };

        //return $this->copy()->walk_recursive($func);
        return self::linspace($start, $end, $num, $endpoint)->walk_recursive($func);
    }
}
