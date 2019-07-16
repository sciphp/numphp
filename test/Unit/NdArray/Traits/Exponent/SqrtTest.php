<?php

namespace SciPhpTest\Unit\NdArray\Traits\Exponent;

use SciPhpTest\Unit\MultiRunner;

class SqrtTest extends MultiRunner
{
    public function getScenarios()
    {
        // method / input / expected / args
        return [
            ['sqrt', [0, 1], [0, 1]                                    ],
            ['sqrt', [[4, 1], [1, 9]], [[2, 1], [1, 3]]                ],
            ['sqrt', [[-1, 2], [3, 4]],  \InvalidArgumentException::class,],
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
