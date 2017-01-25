<?php

namespace SciPhpTest\Unit\NumPhp\Traits\NumArray;

use SciPhpTest\Unit\MultiRunner;

class FullLikeTest extends MultiRunner
{
  public function getScenarios()
  {
    // method / input / expected / args
    return [
      // 1 dim
      ['full_like', [2], [INF], [INF]],
      // 2 dim / arg=tuple like
      ['full_like', [[1, 2], [3, 4]], [[INF, INF], [INF, INF]], [INF] ],
      // 3 dim
      ['full_like', [[[1, 2]], [[3, 4]]], [[[INF, INF]], [[INF, INF]]], [INF] ],

      # \InvalidArgumentException
      ['full_like', 'hello', \InvalidArgumentException::class ],
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
