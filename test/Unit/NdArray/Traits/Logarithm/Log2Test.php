<?php

namespace SciPhpTest\Unit\NdArray\Traits\Logarithm;

use SciPhpTest\Unit\MultiRunner;

class Log2Test extends MultiRunner
{
  public function getScenarios()
  {
    // method / input / expected / args
    return [
      ['log2', [1, 2, 3, 4],   [0, 1, 1.5849625007212, 2]],
      ['log2', [[1, 2, 3, 4]], [[0, 1, 1.5849625007212, 2]]],

      # \InvalidArgumentException
      ['log2', [1, 0, 1],         \InvalidArgumentException::class],
      ['log2', [[1, 2], [0, 1]],  \InvalidArgumentException::class],
      ['log2', [1, null, 1],      \InvalidArgumentException::class],
      ['log2', [[1, 2], [null, 1]],\InvalidArgumentException::class],
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
