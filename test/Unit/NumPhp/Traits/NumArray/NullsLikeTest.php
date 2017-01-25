<?php

namespace SciPhpTest\Unit\NumPhp\Traits\NumArray;

use SciPhpTest\Unit\MultiRunner;

class NullsLikeTest extends MultiRunner
{
  public function getScenarios()
  {
    // method / input / expected / args
    return [
      // 1 dim
      ['nulls_like', [2], [null]],
      // 2 dim / arg=tuple like
      ['nulls_like', [[1, 2], [3, 4]], [[null, null], [null, null]] ],
      // 3 dim
      ['nulls_like', [[[1, 2]], [[3, 4]]], [[[null, null]], [[null, null]]] ],

      # \InvalidArgumentException
      ['nulls_like', 'hello', \InvalidArgumentException::class ],
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
