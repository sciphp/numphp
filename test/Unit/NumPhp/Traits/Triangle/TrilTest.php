<?php

namespace SciPhpTest\Unit\NumPhp\Traits\Triangle;

use SciPhp\NumPhp as np;
use SciPhpTest\Unit\MultiRunner;

class TrilTest extends MultiRunner
{
  public function getScenarios()
  {
    // method / input / expected / args
    return [
      // Empty arrays
      ['tril', np::ar([]), [[]] ],
      ['tril', np::ar([[]]), [[]], [-1] ],

      // PHP arrays
      ['tril', np::linspace(1, 9, 9)->reshape(3, 3)->data,
        [[1, 0, 0],
         [4, 5, 0],
         [7, 8, 9]],
      ],

      // square arrays
      ['tril', np::linspace(1, 9, 9)->reshape(3, 3),
        [[1, 0, 0],
         [4, 5, 0],
         [7, 8, 9]],
      ],

      // square arrays, positive offset
      ['tril', np::linspace(1, 9, 9)->reshape(3, 3),
        [[1, 2, 0],
         [4, 5, 6],
         [7, 8, 9]],
        [1]
      ],
      ['tril', np::linspace(1, 9, 9)->reshape(3, 3),
        [[1, 2, 3],
         [4, 5, 6],
         [7, 8, 9]],
        [2]
      ],

      // square arrays, negative offset
      ['tril', np::linspace(1, 9, 9)->reshape(3, 3),
        [[0, 0, 0],
         [4, 0, 0],
         [7, 8, 0]],
        [-1]
      ],
      ['tril', np::linspace(1, 9, 9)->reshape(3, 3),
        [[0, 0, 0],
         [0, 0, 0],
         [7, 0, 0]],
        [-2]
      ],

      // non square arrays, default offset
      ['tril', np::linspace(1, 8, 8)->reshape(4, 2),
        [[1, 0],
         [3, 4],
         [5, 6],
         [7, 8]],
      ],
      ['tril', np::linspace(1, 8, 8)->reshape(2, 4),
        [[1, 0, 0, 0],
         [5, 6, 0, 0]],
      ],

      // non square arrays, positive offset
      ['tril', np::linspace(1, 8, 8)->reshape(4, 2),
        [[1, 2],
         [3, 4],
         [5, 6],
         [7, 8]],
        [1]
      ],
      ['tril', np::linspace(1, 8, 8)->reshape(2, 4),
        [[1, 2, 0, 0],
         [5, 6, 7, 0]],
        [1]
      ],
      ['tril', np::linspace(1, 8, 8)->reshape(2, 4),
        [[1, 2, 3, 0],
         [5, 6, 7, 8]],
        [2]
      ],

      // non square arrays, negative offset
      ['tril', np::linspace(1, 8, 8)->reshape(4, 2),
        [[0, 0],
         [3, 0],
         [5, 6],
         [7, 8]],
        [-1]
      ],
      ['tril', np::linspace(1, 8, 8)->reshape(4, 2),
        [[0, 0],
         [0, 0],
         [5, 0],
         [7, 8]],
        [-2]
      ],
      ['tril', np::linspace(1, 8, 8)->reshape(2, 4),
        [[0, 0, 0, 0],
         [5, 0, 0, 0]],
        [-1]
      ],
      ['tril', np::linspace(1, 8, 8)->reshape(2, 4),
        [[0, 0, 0, 0],
         [0, 0, 0, 0]],
        [-2]
      ],

      # \InvalidArgumentException
      ['tril', 'hello',  \InvalidArgumentException::class],
      ['tril', [1, 2, 3],\InvalidArgumentException::class, ['hello']],
      ['tril', [1, 2, 3],\InvalidArgumentException::class, [0.5]],
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
