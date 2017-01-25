<?php

namespace SciPhpTest\Unit\NumPhp\Traits\NumArray;

use SciPhpTest\Unit\MultiRunner;

class OnesLikeTest extends MultiRunner
{
  public function getScenarios()
  {
    // method / input / expected / args
    return [
      // 1 dim
      ['ones_like', [2], [1]],
      // 2 dim / arg=tuple like
      ['ones_like', [[1, 2], [3, 4]], [[1, 1], [1, 1]] ],
      // 3 dim
      ['ones_like', [[[1, 2]], [[3, 4]]], [[[1, 1]], [[1, 1]]] ],

      # \InvalidArgumentException
      ['ones_like', 'hello', \InvalidArgumentException::class ],
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
