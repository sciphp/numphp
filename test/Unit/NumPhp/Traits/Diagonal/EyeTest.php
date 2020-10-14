<?php

namespace SciPhpTest\Unit\NumPhp\Traits\Diagonal;

use SciPhp\NumPhp as np;
use SciPhpTest\Unit\MultiRunner;

class EyeTest extends MultiRunner
{
  public function getScenarios()
  {
    // method / input / expected / args
    return [
      // square arrays
      ['eye', 4,
        [[1, 0, 0, 0],
         [0, 1, 0, 0],
         [0, 0, 1, 0],
         [0, 0, 0, 1]],
      ],
      ['eye', 4,
        [[1, 0, 0, 0],
         [0, 1, 0, 0],
         [0, 0, 1, 0],
         [0, 0, 0, 1]],
        [4]
      ],

      // non square arrays, offset=0
      ['eye', 4,
        [[1, 0, 0, 0, 0],
         [0, 1, 0, 0, 0],
         [0, 0, 1, 0, 0],
         [0, 0, 0, 1, 0]],
        [5]
      ],
      ['eye', 5,
        [[1, 0, 0, 0],
         [0, 1, 0, 0],
         [0, 0, 1, 0],
         [0, 0, 0, 1],
         [0, 0, 0, 0]],
        [4]
      ],

      // square arrays, offset=2
      ['eye', 4,
        [[0, 0, 1, 0],
         [0, 0, 0, 1],
         [0, 0, 0, 0],
         [0, 0, 0, 0]],
        [4, 2]
      ],

      // square arrays, offset=-2
      ['eye', 4,
        [[0, 0, 0, 0],
         [0, 0, 0, 0],
         [1, 0, 0, 0],
         [0, 1, 0, 0]],
        [4, -2]
      ],

      // square arrays, offset=2
      ['eye', 4,
        [[0, 0, 1, 0, 0],
         [0, 0, 0, 1, 0],
         [0, 0, 0, 0, 1],
         [0, 0, 0, 0, 0]],
        [5, 2]
      ],

      // square arrays, offset=-2
      ['eye', 5,
        [[0, 0, 0, 0],
         [0, 0, 0, 0],
         [1, 0, 0, 0],
         [0, 1, 0, 0],
         [0, 0, 1, 0]],
        [4, -2]
      ],

      # \InvalidArgumentException
      ['eye', 0.5,        \InvalidArgumentException::class],
      ['eye', -5,         \InvalidArgumentException::class],
      ['eye', 'hello',    \InvalidArgumentException::class],
      ['eye', 1,          \InvalidArgumentException::class, ['hello'] ],
      ['eye', 1,          \InvalidArgumentException::class, [-5] ],
      ['eye', 1,          \InvalidArgumentException::class, [0.5] ],
      ['eye', 1,          \InvalidArgumentException::class, [1, 0.5] ],
      ['eye', 1,          \InvalidArgumentException::class, [1, 'hello'] ],
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
