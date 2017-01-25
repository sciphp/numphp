<?php

namespace SciPhpTest\Unit\NdArray\Traits\Exponent;

use SciPhpTest\Unit\MultiRunner;

class ExpTest extends MultiRunner
{
  public function getScenarios()
  {
    // method / input / expected / args
    return [
      ['exp', [0, 1], [1, 2.71828182846]],
      ['exp', [[0, 1], [1, 0]], [[1, 2.71828182846], 
                                 [2.71828182846, 1]]      
      ]
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
