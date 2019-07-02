<?php

namespace SciPhpTest\NumPhp\Traits\Operation;

use SciPhp\NumPhp as np;
use SciPhpTest\Unit\MultiRunner;

class SumTest extends MultiRunner
{
    public function getScenarios()
    {
        // method / input / expected / args
        return [
            ['sum', [], 0                                              ], # 0 dim
            ['sum', [[]], 0                                            ], # 0 dim
            ['sum', [0, 2, 4], 6                                       ], # 1 dim with values
            ['sum', [[0, 2, 4], [6, 8, 10]], 30                        ], # 2 dim
            ['sum', [[[0, 2, 4]], [[6, 8, 10]]], 30                    ], # 3 dim
            ['sum', [[[0, 2, 4]], [[6, 8, 10]]], [[[30]]], [null, true]], # 3 dim keepdims = true
            
            // Sum over axis
            ['sum', [[0, 1], [0, 5], [2, 0]], [2, 6], [0]              ], # Axis 0
            ['sum', [[0, 1], [0, 5], [2, 0]], [1, 5, 2], [1]           ], # Axis 1

            // Sum over axis and keepdims = true
            ['sum', [[0, 1], [0, 5], [2, 0]], [[2, 6]], [0, true]       ], # Axis 0 keepdims = true
            ['sum', [[0, 1], [0, 5], [2, 0]], [[1], [5], [2]], [1, true]], # Axis 1 keepdims = true
        ];
    }

    /**
     * @dataProvider getScenarios
     */
    public function testScenario($func, $input, $expected, $args = null)
    {
        $this->staticEquals('\SciPhp\NumPhp', $func, $input, $expected, $args);
    }

    /**
     * sum(), lambda
     */
    public function testLambda()
    {
        $this->assertEquals(
            6,
            np::sum(6)
        );
    }

    /**
     * Invalid argument
     */
    public function testInvalidArgumentException()
    {
        $this->expectException(\InvalidArgumentException::class);

        np::sum('hello');
    }
}
