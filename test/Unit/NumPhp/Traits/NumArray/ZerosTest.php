<?php

namespace SciPhpTest\Unit\NumPhp\Traits\NumArray;

use SciPhpTest\Unit\MultiRunner;

class ZerosTest extends MultiRunner
{
    public function getScenarios()
    {
        // method / input / expected / args
        return [
            // 1 dim
            ['zeros', 2 , [0, 0]],
            // 2 dim / arg=tuple like
            ['zeros', 2 , [[0, 0, 0], [0, 0, 0]], [3]],
            // 2 dim / arg=shape like
            ['zeros', [2, 3] , [[0, 0, 0], [0, 0, 0]]],
            // 3 dim
            ['zeros', 1 , [[[0, 0], [0, 0], [0, 0]]], [3, 2]],

            # \InvalidArgumentException
            ['zeros', 'hello',  \InvalidArgumentException::class ],
            ['zeros', -1,       \InvalidArgumentException::class ],
            ['zeros', 0.5,      \InvalidArgumentException::class ],
            ['zeros', [1, 'hello'], \InvalidArgumentException::class ],
            ['zeros', [1, -1],  \InvalidArgumentException::class ],
            ['zeros', [1, 0.5], \InvalidArgumentException::class ],
            ['zeros', 2,        \InvalidArgumentException::class, ['hello']    ], 
            ['zeros', 5,        \InvalidArgumentException::class, [6, 'hello'] ]
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
