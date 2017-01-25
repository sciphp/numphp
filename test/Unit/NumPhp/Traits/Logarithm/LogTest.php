<?php

namespace SciPhpTest\Unit\NumPhp\Traits\Logarithm;

use SciPhp\NdArray;
use SciPhp\NumPhp as np;
use SciPhpTest\Unit\MultiRunner;

class LogTest extends MultiRunner
{
  public function getScenarios()
  {
    // method / input / expected / args
    return [
      ['log', 1, 0],
      ['log', [1, 2, 4], [0, 0.69314718055995, 1.3862943611199]],
      ['log', new NdArray([1, 2, 4]), [0, 0.69314718055995, 1.3862943611199]],
      ['log', [[1, 2, 4], [4, 2, 1]], [[0, 0.69314718055995, 1.3862943611199], 
                                       [1.3862943611199, 0.69314718055995, 0]]      
      ],
      ['log', np::ar([1, 100, 100 ** 2])->vander(),
                                        [[0, 0, 0],
                                         [2, 1, 0],
                                         [4, 2, 0]], [100]],
      # \InvalidArgumentException
      ['log', 0,                 \InvalidArgumentException::class],
      ['log', null,              \InvalidArgumentException::class],
      ['log', false,             \InvalidArgumentException::class],
      ['log', [1, 0, 1],         \InvalidArgumentException::class],
      ['log', [[1, 2], [0, 1]],  \InvalidArgumentException::class],
      ['log', [1, null, 1],      \InvalidArgumentException::class],
      ['log', [[1, 2], [null, 1]],\InvalidArgumentException::class],
      ['log', 'hello',           \InvalidArgumentException::class],
      ['log', [1, 2],           \InvalidArgumentException::class, [0]],
      ['log', [1, 2],           \InvalidArgumentException::class, [null]],
      ['log', [1, 2],           \InvalidArgumentException::class, [false]]
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
