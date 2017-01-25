<?php

namespace SciPhpTest\Unit\NumPhp\Traits\NumArray;

use SciPhpTest\Unit\MultiRunner;

class NullsTest extends MultiRunner
{
  public function getScenarios()
  {
    // method / input / expected / args
    return [
      // 1 dim
      ['nulls', 2 , [null, null]],
      // 2 dim / arg=tuple like
      ['nulls', 2 , [[null, null, null], [null, null, null]], [3]],
      // 2 dim / arg=shape like
      ['nulls', [2, 3] , [[null, null, null], [null, null, null]]],
      // 3 dim
      ['nulls', 1 , [[[null, null], [null, null], [null, null]]], [3, 2]],

      # \InvalidArgumentException
      ['nulls', 'hello',      \InvalidArgumentException::class ],
      ['nulls', -1,           \InvalidArgumentException::class ],
      ['nulls', 0.5,          \InvalidArgumentException::class ],
      ['nulls', [1, 'hello'], \InvalidArgumentException::class ],
      ['nulls', [1, -1],      \InvalidArgumentException::class ],
      ['nulls', [1, 0.5],     \InvalidArgumentException::class ],
      ['nulls', 2,            \InvalidArgumentException::class, ['hello']     ], 
      ['nulls', 5,            \InvalidArgumentException::class, [6, 'hello']  ]
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
