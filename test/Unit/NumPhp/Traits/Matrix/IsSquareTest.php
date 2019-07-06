<?php

namespace SciPhpTest\Unit\NumPhp\Traits\Matrix;

use SciPhp\NumPhp as np;
use SciPhpTest\Unit\MultiRunner;

class IsSquareTest extends MultiRunner
{
    public function getScenarios()
    {
        // method / input / expected / args
        return [
          ['is_square', [0, 1], false                                      ], # 1 dim is not square
          ['is_square', [[0, 1]], false                                    ], # 2 dim but not square
          ['is_square', np::arange(0, 16)->resize(4,4,4)->data, false      ], # 4x4x4 is NOT square
          ['is_square', [[0, 1], [1, 0]], true                             ], # 2x2 is square
          ['is_square', np::arange(0, 9)->reshape(3,3)->data, true         ], # 3x3 is square
          ['is_square', np::arange(0, 16)->reshape(4,4)->data, true        ], # 4x4 is square

          # \InvalidArgumentException
          ['is_square', 'hello', \InvalidArgumentException::class],
          // Too many dim
          ['is_square', 22, \InvalidArgumentException::class],
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
