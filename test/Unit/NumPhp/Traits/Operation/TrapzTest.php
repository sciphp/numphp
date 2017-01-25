<?php

namespace SciPhpTest\Unit\NumPhp\Traits\Operation;

use SciPhp\NdArray;
use SciPhpTest\Unit\MultiRunner;

class TrapzTest extends MultiRunner
{
  public function getScenarios()
  {
    // method / input / expected / args
    return [
      // vector
      ['trapz', [1, 2, 3], 4],
      // vector
      ['trapz', new NdArray([1, 2, 3]), 4],

      # \InvalidArgumentException
      ['trapz', 'hello',       \InvalidArgumentException::class],
      ['trapz', 1,             \InvalidArgumentException::class],
      ['trapz', [[1, 0]],      \InvalidArgumentException::class]
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
