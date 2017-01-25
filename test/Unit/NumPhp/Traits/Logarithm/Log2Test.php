<?php

namespace SciPhpTest\Unit\NumPhp\Traits\Logarithm;

use SciPhpTest\Unit\MultiRunner;
use SciPhp\NumPhp as np;

class Log2Test extends MultiRunner
{
  public function getScenarios()
  {
    // method / input / expected / args
    return [
      ['log2', 4, 2],
      ['log2', [1, 2, 3, 4],   [0, 1, 1.5849625007212, 2]],
      ['log2', [[1, 2, 3, 4]], [[0, 1, 1.5849625007212, 2]]],
      
      # \InvalidArgumentException
      ['log2', 0,                 \InvalidArgumentException::class],
      ['log2', null,              \InvalidArgumentException::class],
      ['log2', false,             \InvalidArgumentException::class],
      ['log2', [1, 0, 1],         \InvalidArgumentException::class],
      ['log2', [[1, 2], [0, 1]],  \InvalidArgumentException::class],
      ['log2', [1, null, 1],      \InvalidArgumentException::class],
      ['log2', [[1, 2], [null, 1]],\InvalidArgumentException::class],
      ['log2', 'hello',           \InvalidArgumentException::class]
    ];
  }

  /**
   * @dataProvider getScenarios
   */
  public function testScenario($func, $input, $expected)
  {
    $this->staticEquals('\SciPhp\NumPhp', $func, $input, $expected);
  }
}
