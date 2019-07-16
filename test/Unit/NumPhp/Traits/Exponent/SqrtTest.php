<?php

namespace SciPhpTest\Unit\NumPhp\Traits\Exponent;

use SciPhpTest\Unit\MultiRunner;

class SqrtTest extends MultiRunner
{
    public function getScenarios()
    {
        // method / input / expected / args
        return [
            ['sqrt', 4, 2                                              ],
            ['sqrt', [0, 1], [0, 1]                                    ],
            ['sqrt', [[4, 1], [1, 9]], [[2, 1], [1, 3]]                ],
            ['sqrt', -1,  \InvalidArgumentException::class,            ],
            ['sqrt', [[-1, 2], [3, 4]],  \InvalidArgumentException::class,],
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
