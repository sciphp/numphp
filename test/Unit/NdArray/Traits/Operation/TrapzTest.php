<?php

namespace SciPhpTest\Unit\NdArray\Traits\Operation;

use SciPhpTest\Unit\MultiRunner;

class TrapzTest extends MultiRunner
{
  public function getScenarios()
  {
    // method / input / expected / args
    return [
      // vector
      ['trapz', [1, 2, 3], 4],

      # \InvalidArgumentException
      ['trapz', [[1, 0]],      \InvalidArgumentException::class]
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
