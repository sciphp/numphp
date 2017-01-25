<?php

namespace SciPhpTest\Unit\NdArray\Traits\Float;

use SciPhp\NdArray;
use SciPhpTest\Unit\MultiRunner;

class CopysignTest extends MultiRunner
{
  public function getScenarios()
  {
    // method / input / expected / args
    return [
      // vector lambda
      ['copysign', [1, 0, -1], [-1, 0, -1], [ -1 ]],
      // 2-dim array lambda
      ['copysign', [[1, 0, -1]], [[-1, 0, -1]], [ -1 ]],

      // vector vector
      ['copysign', [1, 0, -1], [-1, 0, 1], [ [-1, 0, 1] ]],
      // vector array
      ['copysign', [1, 0, -1], [[-1, 0, 1]], [ [[-1, 0, 1]] ]],
      // vector NdArray
      ['copysign', [1, 0, -1], [[-1, 0, 1]], [ new NdArray([[-1, 0, 1]]) ]],
      // array vector
      ['copysign', [[1, 0, -1]], [[-1, 0, 1]], [ [-1, 0, 1] ]],

      # \InvalidArgumentException
      ['copysign', [[1, 0]],      \InvalidArgumentException::class, [ [[1, 0, -1]]  ] ],
      ['copysign', [[1, 0, -1]],  \InvalidArgumentException::class, [ [[0, -1]]     ] ],
      ['copysign', [1, 0, -1],    \InvalidArgumentException::class, [ [0, -1]       ] ],
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
