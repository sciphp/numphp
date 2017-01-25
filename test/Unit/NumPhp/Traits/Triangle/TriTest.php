<?php

namespace SciPhpTest\Unit\NumPhp\Traits\Triangle;

use SciPhp\NumPhp as np;
use SciPhpTest\Unit\MultiRunner;

class TriTest extends MultiRunner
{
  public function getScenarios()
  {
    // method / input / expected / args
    return [
      // square arrays
      ['tri', 3,
        [[1, 0, 0],
         [1, 1, 0],
         [1, 1, 1]]
      ],
      ['tri', 3,
        [[1, 0, 0],
         [1, 1, 0],
         [1, 1, 1]],
        [3]
      ],
      // square arrays, negative offset
      ['tri', 3,
        [[0, 0, 0],
         [1, 0, 0],
         [1, 1, 0]],
        [3, -1]
      ],
      ['tri', 3,
        [[0, 0, 0],
         [0, 0, 0],
         [1, 0, 0]],
        [3, -2]
      ],
      // square arrays, positive offset
      ['tri', 3,
        [[1, 1, 0],
         [1, 1, 1],
         [1, 1, 1]],
        [3, 1]
      ],
      ['tri', 3,
        [[1, 1, 1],
         [1, 1, 1],
         [1, 1, 1]],
        [3, 2]
      ],
      // non square arrays, default offset
      ['tri', 4,
        [[1, 0, 0],
         [1, 1, 0],
         [1, 1, 1],
         [1, 1, 1]],
        [3]
      ],
      ['tri', 3,
        [[1, 0, 0, 0],
         [1, 1, 0, 0],
         [1, 1, 1, 0]],
        [4]
      ],

      // non square arrays, negative offset
      ['tri', 4,
        [[0, 0, 0],
         [1, 0, 0],
         [1, 1, 0],
         [1, 1, 1]],
        [3, -1]
      ],
      ['tri', 4,
        [[0, 0, 0],
         [0, 0, 0],
         [1, 0, 0],
         [1, 1, 0]],
        [3, -2]
      ],
      ['tri', 3,
        [[0, 0, 0, 0],
         [1, 0, 0, 0],
         [1, 1, 0, 0]],
        [4, -1]
      ],
      ['tri', 3,
        [[0, 0, 0, 0],
         [0, 0, 0, 0],
         [1, 0, 0, 0]],
        [4, -2]
      ],

      // non square arrays, positive offset
      ['tri', 4,
        [[1, 1, 0],
         [1, 1, 1],
         [1, 1, 1],
         [1, 1, 1]],
        [3, 1]
      ],
      ['tri', 4,
        [[1, 1, 1],
         [1, 1, 1],
         [1, 1, 1],
         [1, 1, 1]],
        [3, 2]
      ],
      ['tri', 3,
        [[1, 1, 0, 0],
         [1, 1, 1, 0],
         [1, 1, 1, 1]],
        [4, 1]
      ],
      ['tri', 3,
        [[1, 1, 1, 0],
         [1, 1, 1, 1],
         [1, 1, 1, 1]],
        [4, 2]
      ],

      # \InvalidArgumentException
      ['tri', 'hello',  \InvalidArgumentException::class],
      ['tri', -1,       \InvalidArgumentException::class],
      ['tri', 0.5,      \InvalidArgumentException::class],
      ['tri', 1,        \InvalidArgumentException::class, ['hello']],
      ['tri', 1,        \InvalidArgumentException::class, [-1]],
      ['tri', 1,        \InvalidArgumentException::class, [0.5]],
      ['tri', 1,        \InvalidArgumentException::class, [1, 'hello']],
      ['tri', 1,        \InvalidArgumentException::class, [1, -0.5]],
      ['tri', 1,        \InvalidArgumentException::class, [1, 0.5]],
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
