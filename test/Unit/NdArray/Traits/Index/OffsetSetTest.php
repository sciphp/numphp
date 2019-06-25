<?php

namespace SciPhpTest\Unit\NdArray\Traits\Index;

use SciPhp\NumPhp as np;
use SciPhpTest\Unit\MultiRunner;

class OffsetSetTest extends MultiRunner
{
  public function getScenarios()
  {
    // method / input / expected / args
    return [
      /*
       * integer
       */
      ['OffsetSet', [0, 1], [2, 1], [0, 2]],
      ['OffsetSet', [0, 1], [0, 2], [1, 2]],

      ['OffsetSet', [[0, 1], [2, 3]], [[4, 4], [2, 3]], [0, 4]],
      ['OffsetSet', [[0, 1], [2, 3]], [[0, 1], [4, 4]], [1, 4]],

      ['OffsetSet', [[[0, 1]], [[2, 3]]], [[[4, 4]], [[2, 3]]], [0, 4]],
      ['OffsetSet', [[[0, 1]], [[2, 3]]], [[[0, 1]], [[4, 4]]], [1, 4]],


      /*
       * string
       */

      // one value
      ['OffsetSet', 
        [[0, 1, 2], [3, 4, 5], [6, 7, 8]],
        [[0, 1, 2], [3, 42, 5], [6, 7, 8]],
        ['1,1', 42]
      ],
      ['OffsetSet', 
        [[0, 1, 2], [3, 4, 5], [6, 7, 8]], 
        [[0, 1, 2], [3, 42, 5], [6, 7, 8]],
        ['1:1,1:1', 42]
      ],
      
      // 1st line
      ['OffsetSet', 
        [[0, 1, 2], [3, 4, 5], [6, 7, 8]], 
        [[42, 42, 42], [3, 4, 5], [6, 7, 8]],
        ['0,', 42]
      ],
      ['OffsetSet', 
        [[0, 1, 2], [3, 4, 5], [6, 7, 8]], 
        [[42, 42, 42], [3, 4, 5], [6, 7, 8]],
        ['0', 42]
      ],
      ['OffsetSet', 
        [[0, 1, 2], [3, 4, 5], [6, 7, 8]], 
        [[42, 42, 42], [3, 4, 5], [6, 7, 8]],
        ['0,:', 42]
      ],
      ['OffsetSet', 
        [[0, 1, 2], [3, 4, 5], [6, 7, 8]], 
        [[42, 42, 42], [3, 4, 5], [6, 7, 8]],
        ['0, 0:2', 42]
      ],
      ['OffsetSet', 
        [[0, 1, 2], [3, 4, 5], [6, 7, 8]], 
        [[42, 42, 42], [3, 4, 5], [6, 7, 8]],
        ['0, 0:-1', 42]
      ],
      // 2nd line
      ['OffsetSet', 
        [[0, 1, 2], [3, 4, 5], [6, 7, 8]], 
        [[0, 1, 2], [42, 42, 42], [6, 7, 8]],
        ['1,', 42]
      ],
      ['OffsetSet', 
        [[0, 1, 2], [3, 4, 5], [6, 7, 8]], 
        [[0, 1, 2], [42, 42, 42], [6, 7, 8]],
        ['1', 42]
      ],
      ['OffsetSet', 
        [[0, 1, 2], [3, 4, 5], [6, 7, 8]], 
        [[0, 1, 2], [42, 42, 42], [6, 7, 8]],
        ['1,:', 42]
      ],
      ['OffsetSet', 
        [[0, 1, 2], [3, 4, 5], [6, 7, 8]], 
        [[0, 1, 2], [42, 42, 42], [6, 7, 8]],
        ['1, 0:2', 42]
      ],
      ['OffsetSet', 
        [[0, 1, 2], [3, 4, 5], [6, 7, 8]], 
        [[0, 1, 2], [42, 42, 42], [6, 7, 8]],
        ['1, 0:-1', 42]
      ],

      // 1st col
      ['OffsetSet', 
        [[0, 1, 2], [3, 4, 5], [6, 7, 8]], 
        [[42, 1, 2], [42, 4, 5], [42, 7, 8]],
        [':,0', 42]
      ],
      ['OffsetSet', 
        [[0, 1, 2], [3, 4, 5], [6, 7, 8]], 
        [[42, 1, 2], [42, 4, 5], [42, 7, 8]],
        ['0:2,0', 42]
      ],
      ['OffsetSet', 
        [[0, 1, 2], [3, 4, 5], [6, 7, 8]], 
        [[42, 1, 2], [42, 4, 5], [42, 7, 8]],
        [':,0:0', 42]
      ],
      // 2nd col
      ['OffsetSet', 
        [[0, 1, 2], [3, 4, 5], [6, 7, 8]], 
        [[0, 42, 2], [3, 42, 5], [6, 42, 8]],
        [':,1', 42]
      ],
      ['OffsetSet', 
        [[0, 1, 2], [3, 4, 5], [6, 7, 8]], 
        [[0, 42, 2], [3, 42, 5], [6, 42, 8]],
        ['0:2,1', 42]
      ],
      ['OffsetSet', 
        [[0, 1, 2], [3, 4, 5], [6, 7, 8]], 
        [[0, 42, 2], [3, 42, 5], [6, 42, 8]],
        [':,-2', 42]
      ],
      ['OffsetSet', 
        [[0, 1, 2], [3, 4, 5], [6, 7, 8]], 
        [[0, 42, 2], [3, 42, 5], [6, 42, 8]],
        [':,-2:-2', 42]
      ],
      // last cols
      ['OffsetSet', 
        [[0, 1, 2], [3, 4, 5], [6, 7, 8]], 
        [[0, 42, 42], [3, 42, 42], [6, 42, 42]],
        [':,-2:', 42]
      ],
      ['OffsetSet', 
        [[0, 1, 2], [3, 4, 5], [6, 7, 8]], 
        [[0, 42, 42], [3, 42, 42], [6, 42, 42]],
        [':,-2:-1', 42]
      ],
      
      // 2nd row / 2 last cols
      ['OffsetSet', 
        [[0, 1, 2], [3, 4, 5], [6, 7, 8]], 
        [[0, 1, 2], [3, 42, 42], [6, 7, 8]],
        ['1, 1:2', 42]
      ],

      // 2nd col / 2 last rows
      ['OffsetSet', 
        [[0, 1, 2], [3, 4, 5], [6, 7, 8]], 
        [[0, 1, 2], [3, 42, 5], [6, 42, 8]],
        ['1:2, 1', 42]
      ],



      # \InvalidArgumentException
      ['OffsetSet', [[[1, 2], [3, 4]]],\InvalidArgumentException::class, [',', 1]],
      ['OffsetSet', [[[1, 2], [3, 4]]],\InvalidArgumentException::class, [',1', 1]],
      ['OffsetSet', [[[1, 2], [3, 4]]],\InvalidArgumentException::class, [2.5, 1]],
      // int:OutOfBound line
      ['OffsetSet', [[[1, 2], [3, 4]]],\InvalidArgumentException::class, [2, 1]],
      // string:OutOfBound column
      ['OffsetSet', [[[1, 2], [3, 4]]],\InvalidArgumentException::class, [',5', 1]],
      // string:OutOfBound line
      ['OffsetSet', [[[1, 2], [3, 4]]],\InvalidArgumentException::class, ['5,', 1]],
      ['OffsetSet', [[1, 2], [3, 4]],  \InvalidArgumentException::class, ['0.5', 1] ],
      ['OffsetSet', [[1, 2], [3, 4]],  \InvalidArgumentException::class, ['hello', 1] ],
      ['OffsetSet', [[1, 2], [3, 4]],  \InvalidArgumentException::class, [[], 1] ],
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
