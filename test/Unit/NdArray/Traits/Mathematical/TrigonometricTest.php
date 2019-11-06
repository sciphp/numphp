<?php

namespace SciPhpTest\Unit\NdArray\Traits\Mathematical;

use SciPhp\NdArray;
use SciPhpTest\Unit\MultiRunner;

class TrigonometricTest extends MultiRunner
{
    public function getScenarios()
    {
        // method / input / expected / args
        return [
            ['cos', [0, M_PI_2, M_PI], [1, 0, -1] ],
            ['cos', [[0, M_PI_2, M_PI], [M_PI, M_PI_2, 0 ]], [[1, 0, -1], [-1, 0, 1]] ],
        ];
    }

   /**
    * @dataProvider getScenarios
    */
    public function testScenario($func, $input, $expected, $args = null)
    {
        $this->equals(NdArray::class, $func, $input, $expected, $args);
    }
}