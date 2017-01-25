<?php

namespace SciPhpTest\Unit\NumPhp\Traits\NumArray;

use SciPhpTest\Unit\MultiRunner;

class FullTest extends MultiRunner
{
  public function getScenarios()
  {
    // method / input / expected / args
    return [
      // 1 dim
      ['full', [2] , [INF, INF], [INF]],
      // 2 dim / arg=tuple like
      ['full', [2, 3] , [[INF, INF, INF], [INF, INF, INF]], [INF]],
      // 3 dim
      ['full', [1, 3, 2] , [[[INF, INF], [INF, INF], [INF, INF]]], [INF]],

      # \InvalidArgumentException
      ['full', [1, 'hello'], \InvalidArgumentException::class, [null] ],
      ['full', [1, -1],      \InvalidArgumentException::class, [null] ],
      ['full', [1, 0.5],     \InvalidArgumentException::class, [null] ],
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
