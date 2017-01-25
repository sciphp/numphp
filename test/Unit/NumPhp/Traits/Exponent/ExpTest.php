<?php

namespace SciPhpTest\Unit\NumPhp\Traits\Exponent;

use SciPhp\NdArray;
use SciPhpTest\Unit\MultiRunner;

class ExpTest extends MultiRunner
{
  public function getScenarios()
  {
    // method / input / expected / args
    return [
      ['exp', 0, 1],
      ['exp', 1, 2.71828182846],
      ['exp', [0, 1], [1, 2.71828182846]],
      ['exp', new NdArray([0, 1]), [1, 2.71828182846]],
      ['exp', [[0, 1], [1, 0]], [[1, 2.71828182846],
                                 [2.71828182846, 1]]
      ],

      # \InvalidArgumentException
      ['exp', 'hello',           \InvalidArgumentException::class],
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
