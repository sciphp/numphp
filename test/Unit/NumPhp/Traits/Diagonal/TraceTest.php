<?php

namespace SciPhpTest\Unit\NumPhp\Traits\Diagonal;

use SciPhp\NdArray;
use SciPhpTest\Unit\MultiRunner;

class TraceTest extends MultiRunner
{
  public function getScenarios()
  {
    // method / input / expected / args
    return [
      ['trace', [0, 1], 0],
      ['trace', [0, 1], 0],
      ['trace', new NdArray([0, 1]), 0],
      ['trace', [[0, 1], [1, 0]], 0],
      ['trace', [[0, 1], [1, 0]], 1, [1]],
      ['trace', [[0, 1], [1, 0]], 1, [-1]],

      # \InvalidArgumentException
      ['trace', 'hello',          \InvalidArgumentException::class],
      ['trace', '1',              \InvalidArgumentException::class],
      ['trace', [[[1,2],[3,4]]],  \InvalidArgumentException::class],
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
