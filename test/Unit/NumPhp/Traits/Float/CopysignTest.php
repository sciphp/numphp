<?php

namespace SciPhpTest\Unit\NumPhp\Traits\Float;

use SciPhp\NdArray;
use SciPhpTest\Unit\MultiRunner;

class CopysignTest extends MultiRunner
{
  public function getScenarios()
  {
    // method / input / expected / args
    return [
      // lambda / lambda
      ['copysign', 1, 1, [1]],
      ['copysign', 1, -1, [-1]],
      ['copysign', -1, 1, [1]],
      ['copysign', -1, -1, [-1]],

      // lambda  vector
      ['copysign', 1, [1, 1, -1], [ [1, 0, -1] ]],
      // lambda  2-dim array
      ['copysign', 1, [[1, 1, -1]], [ [[1, 0, -1]] ]],
      // vector lambda
      ['copysign', [1, 0, -1], [-1, 0, -1], [ -1 ]],
      // 2-dim array lambda
      ['copysign', [[1, 0, -1]], [[-1, 0, -1]], [ -1 ]],

      // vector vector
      ['copysign', [1, 0, -1], [-1, 0, 1], [ [-1, 0, 1] ]],
      // vector array
      ['copysign', [1, 0, -1], [[-1, 0, 1]], [ [[-1, 0, 1]] ]],
      // array vector
      ['copysign', [[1, 0, -1]], [[-1, 0, 1]], [ [-1, 0, 1] ]],

      # \InvalidArgumentException
      ['copysign', 'hello',       \InvalidArgumentException::class, [1]],
      ['copysign', 1,             \InvalidArgumentException::class, ['hello']],
      ['copysign', [[1, 0]],      \InvalidArgumentException::class, [ [[1, 0, -1]]] ],
      ['copysign', [[1, 0, -1]],  \InvalidArgumentException::class, [ [[0, -1]] ] ],
      ['copysign', [1, 0, -1],    \InvalidArgumentException::class, [ [0, -1] ] ],
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
