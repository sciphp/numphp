<?php

namespace SciPhpTest\Unit\NdArray\Traits\Exponent;

use SciPhpTest\Unit\MultiRunner;

class Expm1Test extends MultiRunner
{
  public function getScenarios()
  {
    // method / input / expected / args
    return [
      ['expm1', [0, 1], [0, 1.718281828459]],
      ['expm1', [[0, 1], [1, 0]], [[0, 1.718281828459], 
                                  [1.718281828459, 0]]      
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
