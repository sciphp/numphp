<?php

namespace SciPhpTest\Unit\NumPhp\Traits\Diagonal;

use SciPhp\NumPhp as np;
use SciPhpTest\Unit\MultiRunner;

class DiagflatTest extends MultiRunner
{
  public function getScenarios()
  {
    // method / input / expected / args
    return [
      ['diagflat', np::linspace(1, 4, 4)->reshape(2, 2),
        [[1, 0, 0, 0],
         [0, 2, 0, 0], 
         [0, 0, 3, 0], 
         [0, 0, 0, 4]]
      ],

      ['diagflat', np::linspace(1, 4, 4)->reshape(2, 2)->data,
        [[1, 0, 0, 0],
         [0, 2, 0, 0], 
         [0, 0, 3, 0], 
         [0, 0, 0, 4]]
      ],
      
      // offset=1
      ['diagflat', np::linspace(1, 4, 4)->reshape(2, 2)->data,
        [[0, 1, 0, 0, 0],
         [0, 0, 2, 0, 0], 
         [0, 0, 0, 3, 0], 
         [0, 0, 0, 0, 4]],
        [1]
      ],

      // offset=-1
      ['diagflat', np::linspace(1, 4, 4)->reshape(2, 2)->data,
        [[0, 0, 0, 0], 
         [1, 0, 0, 0],
         [0, 2, 0, 0], 
         [0, 0, 3, 0], 
         [0, 0, 0, 4]],
        [-1]
      ],

      # \InvalidArgumentException
      ['diagflat', 'hello',       \InvalidArgumentException::class],
      ['diagflat', [1, 2],        \InvalidArgumentException::class, [0.5] ],
      ['diagflat', [1, 2],        \InvalidArgumentException::class, ['hello'] ],
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
