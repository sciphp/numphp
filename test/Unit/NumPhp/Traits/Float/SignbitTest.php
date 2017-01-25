<?php

namespace SciPhpTest\Unit\NumPhp\Traits\Float;

use SciPhp\NdArray;
use SciPhpTest\Unit\MultiRunner;

class SignbitTest extends MultiRunner
{
  public function getScenarios()
  {
    // method / input / expected / args
    return [
      ['signbit', 1, false],
      ['signbit', -1, true],
      ['signbit', 0, false],
      ['signbit', [-1, 1], [true, false]],
      ['signbit', new NdArray([-1, 1]), [true, false]],
      ['signbit', [[-1, 1], [1, -1]], [[true, false],
                                       [false, true]]
      ],

      # \InvalidArgumentException
      ['signbit', 'hello',           \InvalidArgumentException::class],
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
