<?php

namespace SciPhpTest\Unit\NumPhp\Traits\Logarithm;

use SciPhpTest\Unit\MultiRunner;
use SciPhp\NumPhp as np;

class Log10Test extends MultiRunner
{
  public function getScenarios()
  {
    // method / input / expected / arg
    return [
      ['log10', 10, 1],
      ['log10', [1, 10, 100, 1000],   [0, 1, 2, 3]],
      ['log10', [[1, 10, 100, 1000]], [[0, 1, 2, 3]]],
      
      # \InvalidArgumentException
      ['log10', 0,                 \InvalidArgumentException::class],
      ['log10', null,              \InvalidArgumentException::class],
      ['log10', false,             \InvalidArgumentException::class],
      ['log10', -5,                \InvalidArgumentException::class],
      ['log10', [1, 0, 1],         \InvalidArgumentException::class],
      ['log10', [[1, 2], [0, 1]],  \InvalidArgumentException::class],
      ['log10', [1, null, 1],      \InvalidArgumentException::class],
      ['log10', [[1, 2], [null, 1]],\InvalidArgumentException::class],
      ['log10', 'hello',           \InvalidArgumentException::class]
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
