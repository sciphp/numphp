<?php

namespace SciPhpTest\Unit\NdArray\Traits\Exponent;

use SciPhpTest\Unit\MultiRunner;

class Exp2Test extends MultiRunner
{
  public function getScenarios()
  {
    // method / input / expected / args
    return [
      ['exp2', [0, 1], [1, 2]],
      ['exp2', [[0, 1], [1, 0]], [[1, 2], 
                                  [2, 1]]      
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
