<?php

namespace SciPhpTest\Unit\NumPhp\Traits\Diagonal;

use SciPhp\NumPhp as np;
use SciPhpTest\Unit\MultiRunner;

class TransposeTest extends MultiRunner
{
  public function getScenarios()
  {
    // method / input / expected / args
    return [
      // square arrays
      ['transpose', np::linspace(1, 9, 9)->reshape(3, 3),
        [[ 1, 4, 7 ],
         [ 2, 5, 8 ],
         [ 3, 6, 9 ]]
      ],
      ['transpose', [[1, 2, 3], [4, 5, 6], [7, 8, 9]],
        [[ 1, 4, 7 ],
         [ 2, 5, 8 ],
         [ 3, 6, 9 ]]
      ],

      // non square arrays
      ['transpose', np::linspace(1, 6, 6)->reshape(2, 3),
        [[ 1, 4 ],
         [ 2, 5 ],
         [ 3, 6 ]]
      ],
      ['transpose', np::linspace(1, 6, 6)->reshape(3, 2),
        [[ 1, 3, 5 ],
         [ 2, 4, 6 ]]
      ],

      // vectors
      ['transpose', np::linspace(1, 3, 3),[1, 2, 3]     ],
      ['transpose', [1, 2, 3], [1, 2, 3]                ],

      # \InvalidArgumentException
      ['transpose', 'hello',    \InvalidArgumentException::class],
      // Too many dim
      ['transpose', [[[1, 2, 3]]],\InvalidArgumentException::class],
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
