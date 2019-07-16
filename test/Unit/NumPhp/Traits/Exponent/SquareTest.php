<?php

namespace SciPhpTest\Unit\NumPhp\Traits\Exponent;

use SciPhpTest\Unit\MultiRunner;

class SquareTest extends MultiRunner
{
    public function getScenarios()
    {
        // method / input / expected / args
        return [
            ['square', 2, 4                                            ],
            ['square', [0, 1], [0, 1]                                  ],
            ['square', [[2, 1], [1, 3]], [[4, 1], [1, 9]]              ],
        ];
    }

    /**
     * @dataProvider getScenarios
     */
    public function testScenario($func, $input, $expected, $args = null)
    {
        $this->staticEquals('\SciPhp\NumPhp', $func, $input, $expected, $args);
    }
}
