<?php

namespace SciPhpTest\Unit\NdArray\Traits\Logarithm;

use SciPhpTest\Unit\MultiRunner;
use SciPhp\NumPhp as np;

class LogTest extends MultiRunner
{
  public function getScenarios()
  {
    // method / input / expected / args
    return [
      ['log', [1, 2, 4], [0, 0.69314718055995, 1.3862943611199]],
      ['log', [[1, 2, 4], [4, 2, 1]], [[0, 0.69314718055995, 1.3862943611199], 
                                       [1.3862943611199, 0.69314718055995, 0]]],
      ['log', [1, M_E, M_E ** 2, M_E ** 3], [0, 1, 2, 3]],
      ['log', np::ar([1, 100, 100 ** 2])->vander()->data, [[0, 0, 0],
                                                           [2, 1, 0],
                                                           [4, 2, 0]], [100]],
      
      #log() base 100
      ['log', [[1, M_E, M_E ** 2, M_E ** 3]], [[0, 1, 2, 3]]],

      # \InvalidArgumentException
      ['log', [1, 1, 1],         \InvalidArgumentException::class, [0]],
      ['log', [1, 1, 1],         \InvalidArgumentException::class, [null]],
      ['log', [1, 1, 1],         \InvalidArgumentException::class, [false]],
      ['log', [1, 0, 1],         \InvalidArgumentException::class],
      ['log', [[1, 2], [0, 1]],  \InvalidArgumentException::class],
      ['log', [1, null, 1],      \InvalidArgumentException::class],
      ['log', [[1, 2], [null, 1]],\InvalidArgumentException::class]
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
