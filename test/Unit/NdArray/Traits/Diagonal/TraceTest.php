<?php

namespace SciPhpTest\Unit\NdArray\Traits\Diagonal;

use SciPhpTest\Unit\MultiRunner;

class TraceTest extends MultiRunner
{
  public function getScenarios()
  {
    // method / input / expected / args
    return [
      ['trace', [0, 1], 0],
      ['trace', [0, 1], 0],
      ['trace', [[0, 1], [1, 0]], 0],
      ['trace', [[0, 1], [1, 0]], 1, [1]],
      ['trace', [[0, 1], [1, 0]], 1, [-1]],

      # \InvalidArgumentException
      ['trace', [[[1, 2], [3, 4]]],\InvalidArgumentException::class],
      ['trace', [[1, 2], [3, 4]],  \InvalidArgumentException::class, [0.5] ],
      ['trace', [[1, 2], [3, 4]],  \InvalidArgumentException::class, ['hello'] ],
    ];
  }

  /**
   * @dataProvider getScenarios
   */
  public function testScenario($func, $input, $expected, $args = null)
  {
    $this->equals(\SciPhp\NdArray::class, $func, $input, $expected, $args);
  }

  /**
   * tril(), square array, positive offset
   */
  //~ public function testSquareArrayPositiveOffset()
  //~ {
    //~ $m = \SciPhp\NumPhp::linspace(1, 9, 9)->reshape(3, 3);
    
    //~ // M 3*3, offset=1
    //~ $this->assertEquals(
      //~ 15,
      //~ $m->trace(),
      //~ 15
    //~ );
  //~ }
}
