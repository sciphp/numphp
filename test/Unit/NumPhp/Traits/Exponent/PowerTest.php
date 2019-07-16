<?php

namespace SciPhpTest\Unit\NumPhp\Traits\Exponent;

use SciPhpTest\Unit\MultiRunner;

class PowerTest extends MultiRunner
{
    public function getScenarios()
    {
        // method / input / expected / args
        return [
            ['power', 0, 0, [2]                                                       ],
            ['power', 0, 1, [0]                                                       ],
            ['power', 3, 27, [3]                                                      ],

            ['power', [0, 1, 3], [0, 1, 27], [3]                                      ],
            ['power', [[2,3],[4,5]], [[8,27],[64,125]], [3]                           ],

            # \InvalidArgumentException
            ['power', 'hello',     \InvalidArgumentException::class, [2]              ],
            ['power', 2,           \InvalidArgumentException::class, ['hello']        ],
            ['power', 'h',         \InvalidArgumentException::class, ['hello']        ],
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
