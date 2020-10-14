<?php

namespace SciPhpTest\NdArray\Traits\Visitor;

use PHPUnit\Framework\TestCase;
use SciPhp\NumPhp as np;
use SciPhpTest\Unit\MultiRunner;

class AxisTest extends MultiRunner
{
    public function getScenarios()
    {
        $func = function () {};
        // method / input / expected / args
        return [

              # \InvalidArgumentException
            ['axis', [1, 0, 1],         \InvalidArgumentException::class, [$func, 1]],   # must be less than ndim - 1
            ['axis', [1, 0, 1],         \InvalidArgumentException::class, [$func, -1]],  # must be greater than 0
            ['axis', [[1, 0, 1]],       \InvalidArgumentException::class, [$func, 0.5]], # must be an integer
            ['axis', [[[1, 0, 1]]],     \InvalidArgumentException::class, [$func, 2]],   # Cannot be used on matrices with a dimension > 2
        ];
    }

    /**
     * @dataProvider getScenarios
     */
    public function testScenario($func, $input, $expected, $args = null)
    {
        $this->equals('\SciPhp\NdArray', $func, $input, $expected, $args);
    }
}
