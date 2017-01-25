<?php

namespace SciPhpTest\Unit\NumPhp\Traits\NumArray;

use SciPhpTest\Unit\MultiRunner;

class OnesTest extends MultiRunner
{
  public function getScenarios()
  {
    // method / input / expected / args
    return [
      // 1 dim
      ['ones', 2 , [1, 1]],
      // 2 dim / arg=tuple like
      ['ones', 2 , [[1, 1, 1], [1, 1, 1]], [3]],
      // 2 dim / arg=shape like
      ['ones', [2, 3] , [[1, 1, 1], [1, 1, 1]]],
      // 3 dim
      ['ones', 1 , [[[1, 1], [1, 1], [1, 1]]], [3, 2]],

      # \InvalidArgumentException
      ['ones', 'hello',      \InvalidArgumentException::class ],
      ['ones', -1,           \InvalidArgumentException::class ],
      ['ones', 0.5,          \InvalidArgumentException::class ],
      ['ones', [1, 'hello'], \InvalidArgumentException::class ],
      ['ones', [1, -1],      \InvalidArgumentException::class ],
      ['ones', [1, 0.5],     \InvalidArgumentException::class ],
      ['ones', 2,            \InvalidArgumentException::class, ['hello']     ], 
      ['ones', 5,            \InvalidArgumentException::class, [6, 'hello']  ]
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
