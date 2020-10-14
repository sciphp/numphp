<?php

namespace SciPhpTest\Unit\NumPhp\Traits\Diagonal;

use SciPhp\NdArray;
use SciPhpTest\Unit\MultiRunner;

class IdentityTest extends MultiRunner
{
  public function getScenarios()
  {
    // method / input / expected / args
    return [
      ['identity', 3, [[1, 0, 0],
                       [0, 1, 0],
                       [0, 0, 1] ]
      ],

      # \InvalidArgumentException
      ['identity', '-5',           \InvalidArgumentException::class],
      ['identity', '0',           \InvalidArgumentException::class],
      ['identity', '0.5',           \InvalidArgumentException::class],
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
