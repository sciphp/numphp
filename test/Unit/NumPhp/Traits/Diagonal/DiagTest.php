<?php

namespace SciPhpTest\Unit\NumPhp\Traits\Diagonal;

use SciPhp\NumPhp as np;
use SciPhpTest\Unit\MultiRunner;

class DiagTest extends MultiRunner
{
  public function getScenarios()
  {
    // method / input / expected / args
    return [
      // Extract diagonals, offset=0
      ['diag', np::linspace(1, 9, 9)->reshape(3, 3)->data, [1, 5, 9]],
      ['diag', np::linspace(1, 12, 12)->reshape(3, 4), [1, 6, 11]],
      ['diag', np::linspace(1, 12, 12)->reshape(4, 3), [1, 5, 9]],

      // Extract diagonals, offset>0
      ['diag', np::linspace(1, 9, 9)->reshape(3, 3), [2, 6], [1]],
      ['diag', np::linspace(1, 12, 12)->reshape(3, 4), [2, 7, 12], [1]],
      ['diag', np::linspace(1, 12, 12)->reshape(4, 3), [2, 6], [1]],

      // Extract diagonals, offset<0
      ['diag', np::linspace(1, 9, 9)->reshape(3, 3), [4, 8], [-1]],
      ['diag', np::linspace(1, 12, 12)->reshape(3, 4), [5, 10], [-1]],
      ['diag', np::linspace(1, 12, 12)->reshape(4, 3), [4, 8, 12], [-1]],

      // Construct diagonal matrix, offset=0
      ['diag', np::linspace(1, 3, 3), [[1, 0, 0], [0, 2, 0], [0, 0, 3]] ],

      // Construct diagonal matrix, offset=1
      ['diag', np::linspace(1, 3, 3), 
        [[0, 1, 0, 0],
         [0, 0, 2, 0],
         [0, 0 ,0, 3]],
        [1]
      ],
      // Construct diagonal matrix, offset=2
      ['diag', np::linspace(1, 3, 3), 
        [[0, 0, 1, 0, 0],
         [0, 0, 0, 2, 0],
         [0, 0, 0 ,0, 3]],
        [2]
      ],

      // Construct diagonal matrix, offset=-1
      ['diag', np::linspace(1, 3, 3), 
        [[0, 0, 0], 
         [1, 0, 0],
         [0, 2 ,0], 
         [0, 0 ,3]],
        [-1]
      ],
      // Construct diagonal matrix, offset=-2
      ['diag', np::linspace(1, 3, 3), 
        [[0, 0, 0], 
         [0, 0, 0],
         [1, 0 ,0], 
         [0, 2 ,0],
         [0, 0 ,3]],
        [-2]
      ],

      # \InvalidArgumentException
      ['diag', 'hello',       \InvalidArgumentException::class],
      ['diag', np::linspace(0, 12, 12)->reshape(1, 3, 4), \InvalidArgumentException::class],
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
