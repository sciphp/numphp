<?php

namespace SciPhpTest\Unit\NumPhp\Traits\Exponent;

use SciPhp\NdArray;
use SciPhpTest\Unit\MultiRunner;

class Exp2Test extends MultiRunner
{
  public function getScenarios()
  {
    // method / input / expected / args
    return [
      ['exp2', 0, 1],
      ['exp2', 1, 2],
      ['exp2', [0, 1], [1, 2]],
      ['exp2', new NdArray([0, 1]), [1, 2]],
      ['exp2', [[0, 1], [1, 0]], [[1, 2], 
                                  [2, 1]]      
      ],

      # \InvalidArgumentException
      ['exp2', 'hello',           \InvalidArgumentException::class],
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
