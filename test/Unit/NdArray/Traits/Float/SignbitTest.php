<?php

namespace SciPhpTest\Unit\NdArray\Traits\Float;

use SciPhpTest\Unit\MultiRunner;

class SignbitTest extends MultiRunner
{
  public function getScenarios()
  {
    // method / input / expected / args
    return [
      ['signbit', [-1, 1], [true, false]],
      ['signbit', [[-1, 1], [1, -1]], [[true, false],
                                       [false, true]]
      ],
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
