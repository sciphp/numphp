<?php

namespace SciPhpTest\Unit\NdArray\Traits\Logarithm;

use SciPhpTest\Unit\MultiRunner;

class Log10Test extends MultiRunner
{
  public function getScenarios()
  {
    // method / input / expected / args
    return [
      ['log10', [1, 10, 100, 1000],   [0, 1, 2, 3]],
      ['log10', [[1, 10, 100, 1000]], [[0, 1, 2, 3]]],

      # \InvalidArgumentException
      ['log10', [1, 0, 1],         \InvalidArgumentException::class],
      ['log10', [[1, 2], [0, 1]],  \InvalidArgumentException::class],
      ['log10', [1, null, 1],      \InvalidArgumentException::class],
      ['log10', [[1, 2], [null, 1]],\InvalidArgumentException::class],
    ];
  }

  /**
   * @dataProvider getScenarios
   */
  public function testScenario($func, $input, $expected, $args = null)
  {
    $this->equals('\SciPhp\NdArray', $func, $input, $expected, $args);
  }
}
