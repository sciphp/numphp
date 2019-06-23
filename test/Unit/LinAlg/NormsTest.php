<?php

namespace SciPhpTest\Unit\NumPhp\LinAlg;

use SciPhp\NumPhp as np;
use SciPhpTest\Unit\MultiRunner;

class NormsTest extends MultiRunner
{
    public function getScenarios()
    {
        // method / input / expected / args
        return [
            ['norm', [],    0                                          ], # 0 dim
            ['norm', [[]],  0                                          ], # 0 dim
            ['norm', [1, 0, 0],    1                                   ], # 1 dim simple test
            ['norm', [1, -1, 0],  1.4142135623731                      ], # 1 dim
            ['norm', [1, -1, 0],  1.4142135623731                      ], # 2 dim
            ['norm', np::diag([2, 2, 2])->data, 3.4641016151378        ], # 2 dim diagonalized
        ];
    }

    /**
     * @dataProvider getScenarios
     */
    public function testScenario($func, $input, $expected, $args = null)
    {
        $matrix = np::ar($input);

        // Input won be used here
        $this->equals(np::linalg(), $func, null, $expected, $matrix);
    }
}
