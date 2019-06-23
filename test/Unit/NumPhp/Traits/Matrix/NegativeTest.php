<?php

namespace SciPhpTest\Unit\NumPhp\Traits\Diagonal;

use SciPhp\NumPhp as np;
use SciPhpTest\Unit\MultiRunner;

class NegativeTest extends MultiRunner
{
    public function getScenarios()
    {
        // method / input / expected / args
        return [
            ['negative', 42, -42                                                ],
            ['negative', [1, 2, 3], [-1, -2, -3]                ],
            ['negative', [[1, 2, 3]], [[-1, -2, -3]]        ],

            # \InvalidArgumentException
            ['negative', 'hello',        \InvalidArgumentException::class],
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
