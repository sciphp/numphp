<?php

namespace SciPhpTest\Unit\NumPhp\Traits\NumArray;

use SciPhpTest\Unit\MultiRunner;

class BroadcastToTest extends MultiRunner
{
    public function getScenarios()
    {
        // method / input / expected / args
        return [
            // 2 dim - (3,1) -> shape (3,3)
            ['broadcast_to', [[1], [2], [3]], 
                             [[1,1,1],
                              [2,2,2],
                              [3,3,3]], [[3,3]]                        ],

            // 1 dim - (3,) -> shape (3,3)
            ['broadcast_to', [1, 2, 3] , 
                           [ [1, 2, 3],
                             [1, 2, 3],
                             [1, 2, 3] ], [[3,3]]                      ],

            // 1 dim - (3,) -> shape (1,3)
            ['broadcast_to', [1, 2, 3] , 
                            [[1, 2, 3]], [[1,3]]                       ],
                             
            
            ['broadcast_to', [1, 2, 3], \InvalidArgumentException::class, [[3, 1]]           ],  // target shape not valid
            ['broadcast_to', [1, 2, 3], \InvalidArgumentException::class, [[3, 4]]           ],  // target shape not valid
            ['broadcast_to', [[1], [2], [3]], \InvalidArgumentException::class, [[4, 3, 3]]  ],  // ndim(target shape) > 2
            ['broadcast_to', [[[1], [2], [3]]], \InvalidArgumentException::class, [[3, 3]]   ],  // $m->ndim > 3
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
