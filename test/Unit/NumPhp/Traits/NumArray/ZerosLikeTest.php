<?php

namespace SciPhpTest\Unit\NumPhp\Traits\NumArray;

use SciPhpTest\Unit\MultiRunner;

class ZerosLikeTest extends MultiRunner
{
  public function getScenarios()
  {
    // method / input / expected / args
    return [
      // 1 dim
      ['zeros_like', [2], [0]],
      // 2 dim / arg=tuple like
      ['zeros_like', [[1, 2], [3, 4]], [[0, 0], [0, 0]] ],
      // 3 dim
      ['zeros_like', [[[1, 2]], [[3, 4]]], [[[0, 0]], [[0, 0]]] ],

      # \InvalidArgumentException
      ['zeros_like', 'hello', \InvalidArgumentException::class ],
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
