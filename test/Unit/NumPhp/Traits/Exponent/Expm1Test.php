<?php

namespace SciPhpTest\Unit\NumPhp\Traits\Exponent;

use SciPhp\NdArray;
use SciPhpTest\Unit\MultiRunner;

class Expm1Test extends MultiRunner
{
  public function getScenarios()
  {
    // method / input / expm1ected / args
    return [
      ['expm1', 0, 0],
      ['expm1', 1, 1.718281828459],
      ['expm1', [0, 1], [0, 1.718281828459]],
      ['expm1', new NdArray([0, 1]), [0, 1.718281828459]],
      ['expm1', [[0, 1], [1, 0]], [[0, 1.718281828459], 
                                  [1.718281828459, 0]]      
      ],

      # \InvalidArgumentException
      ['expm1', 'hello',           \InvalidArgumentException::class],
    ];
  }

  /**
   * @dataProvider getScenarios
   */
  public function testScenario($func, $input, $expm1ected, $args = null)
  {
    $this->staticEquals('\SciPhp\NumPhp', $func, $input, $expm1ected, $args);
  }
}
