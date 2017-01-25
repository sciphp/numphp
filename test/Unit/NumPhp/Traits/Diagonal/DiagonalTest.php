<?php

namespace SciPhpTest\Unit\NumPhp\Traits\Diagonal;

use SciPhp\NumPhp as np;
use SciPhpTest\Unit\MultiRunner;

class DiagonalTest extends MultiRunner
{
  public function getScenarios()
  {
    // method / input / expected / args
    return [
      // Extract diagonals, offset=0
      ['diagonal', np::linspace(1, 9, 9)->reshape(3, 3)->data, [1, 5, 9]],
      ['diagonal', np::linspace(1, 12, 12)->reshape(3, 4), [1, 6, 11]],
      ['diagonal', np::linspace(1, 12, 12)->reshape(4, 3), [1, 5, 9]],

      // Extract diagonals, offset>0
      ['diagonal', np::linspace(1, 9, 9)->reshape(3, 3), [2, 6], [1]],
      ['diagonal', np::linspace(1, 12, 12)->reshape(3, 4), [2, 7, 12], [1]],
      ['diagonal', np::linspace(1, 12, 12)->reshape(4, 3), [2, 6], [1]],

      // Extract diagonals, offset<0
      ['diagonal', np::linspace(1, 9, 9)->reshape(3, 3), [4, 8], [-1]],
      ['diagonal', np::linspace(1, 12, 12)->reshape(3, 4), [5, 10], [-1]],
      ['diagonal', np::linspace(1, 12, 12)->reshape(4, 3), [4, 8, 12], [-1]],

      # \InvalidArgumentException
      ['diagonal', 'hello',       \InvalidArgumentException::class],
      ['diagonal', [[1, 0], [0, 1]], \InvalidArgumentException::class, ['hello'] ],
      ['diagonal', [[1, 0], [0, 1]], \InvalidArgumentException::class, [0.5] ],
      ['diagonal', np::linspace(0, 12, 12)->reshape(1, 3, 4), \InvalidArgumentException::class],
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
