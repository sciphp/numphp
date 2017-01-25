<?php

namespace SciPhpTest\Unit\NumPhp\Traits\Triangle;

use SciPhp\NumPhp as np;
use SciPhpTest\Unit\MultiRunner;

class TriuTest extends MultiRunner
{
  public function getScenarios()
  {
    // method / input / expected / args
    return [
      // Empty arrays
      ['triu', np::ar([]), [[]] ],
      ['triu', np::ar([[]]), [[]], [-1] ],

      // PHP array
      ['triu', np::linspace(1, 9, 9)->reshape(3, 3)->data,
        [[1, 2, 3],
         [0, 5, 6],
         [0, 0, 9]],
      ],

      // square arrays
      ['triu', np::linspace(1, 9, 9)->reshape(3, 3),
        [[1, 2, 3],
         [0, 5, 6],
         [0, 0, 9]],
      ],

      // square arrays, positive offset
      ['triu', np::linspace(1, 9, 9)->reshape(3, 3),
        [[0, 2, 3],
         [0, 0, 6],
         [0, 0, 0]],
        [1]
      ],
      ['triu', np::linspace(1, 9, 9)->reshape(3, 3),
        [[0, 0, 3],
         [0, 0, 0],
         [0, 0, 0]],
        [2]
      ],

      // square arrays, negative offset
      ['triu', np::linspace(1, 9, 9)->reshape(3, 3),
        [[1, 2, 3],
         [4, 5, 6],
         [0, 8, 9]],
        [-1]
      ],
      ['triu', np::linspace(1, 9, 9)->reshape(3, 3),
        [[1, 2, 3],
         [4, 5, 6],
         [7, 8, 9]],
        [-2]
      ],

      // non square arrays, default offset
      ['triu', np::linspace(1, 8, 8)->reshape(4, 2),
        [[1, 2],
         [0, 4],
         [0, 0],
         [0, 0]],
      ],
      ['triu', np::linspace(1, 8, 8)->reshape(2, 4),
        [[1, 2, 3, 4],
         [0, 6, 7, 8]],
      ],

      // non square arrays, positive offset
      ['triu', np::linspace(1, 8, 8)->reshape(4, 2),
        [[0, 2],
         [0, 0],
         [0, 0],
         [0, 0]],
        [1]
      ],
      ['triu', np::linspace(1, 8, 8)->reshape(4, 2),
        [[0, 0],
         [0, 0],
         [0, 0],
         [0, 0]],
        [2]
      ],
      
      ['triu', np::linspace(1, 8, 8)->reshape(2, 4),
        [[0, 2, 3, 4],
         [0, 0, 7, 8]],
        [1]
      ],
      ['triu', np::linspace(1, 8, 8)->reshape(2, 4),
        [[0, 0, 3, 4],
         [0, 0, 0, 8]],
        [2]
      ],
      ['triu', np::linspace(1, 8, 8)->reshape(2, 4),
        [[0, 0, 0, 4],
         [0, 0, 0, 0]],
        [3]
      ],

      // non square arrays, negative offset
      ['triu', np::linspace(1, 8, 8)->reshape(4, 2),
        [[1, 2],
         [3, 4],
         [0, 6],
         [0, 0]],
        [-1]
      ],
      ['triu', np::linspace(1, 8, 8)->reshape(4, 2),
        [[1, 2],
         [3, 4],
         [5, 6],
         [0, 8]],
        [-2]
      ],
      ['triu', np::linspace(1, 8, 8)->reshape(4, 2),
        [[1, 2],
         [3, 4],
         [5, 6],
         [7, 8]],
        [-3]
      ],
      ['triu', np::linspace(1, 8, 8)->reshape(2, 4),
        [[1, 2, 3, 4],
         [5, 6, 7, 8]],
        [-1]
      ],

      # \InvalidArgumentException
      ['triu', 'hello',  \InvalidArgumentException::class],
      ['triu', [1, 2, 3],\InvalidArgumentException::class, ['hello']],
      ['triu', [1, 2, 3],\InvalidArgumentException::class, [0.5]],
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
