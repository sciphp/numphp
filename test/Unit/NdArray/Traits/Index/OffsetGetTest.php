<?php

namespace SciPhpTest\Unit\NdArray\Traits\Index;

use SciPhp\NumPhp as np;
use SciPhpTest\Unit\MultiRunner;

class OffsetGetTest extends MultiRunner
{
  public function getScenarios()
  {
    // method / input / expected / args
    return [
      /*
       * integer
       */
      ['offsetGet', [0, 1], 0, [0]],
      ['offsetGet', [0, 1], 1, [1]],

      ['offsetGet', [[0, 1], [2, 3]], [0, 1], [0]],
      ['offsetGet', [[0, 1], [2, 3]], [2, 3], [1]],

      /*
       * string
       */

      // one value
      ['offsetGet', 
        [[0, 1, 2], [3, 4, 5], [6, 7, 8]], 
        4,
        ['1,1']
      ],
      ['offsetGet', 
        [[0, 1, 2], [3, 4, 5], [6, 7, 8]], 
        4,
        ['1:1,1:1']
      ],

      // vector
      ['offsetGet', [0, 1], [0, 1], ['0:1']],
      ['offsetGet', 
        [[0, 1, 2], [3, 4, 5], [6, 7, 8]], 
        [[0, 1, 2], [3, 4, 5]],
        ['0:1']
      ],
      
      // 2 rows
      ['offsetGet', 
        [[0, 1, 2], [3, 4, 5], [6, 7, 8]], 
        [[3, 4, 5], [6, 7, 8]],
        ['1:2']
      ],

      // 3 rows & 2 first cols
      ['offsetGet', 
        [[0, 1, 2], [3, 4, 5], [6, 7, 8]], 
        [[0, 1], [3, 4], [6, 7]],
        ['0:2, 0:1']
      ],
      // 3 rows & 2 last cols
      ['offsetGet', 
        [[0, 1, 2], [3, 4, 5], [6, 7, 8]], 
        [[1, 2], [4, 5], [7, 8]],
        ['0:2, 1:2']
      ],
      // 3 rows & 2 last cols
      ['offsetGet', 
        [[0, 1, 2], [3, 4, 5], [6, 7, 8]], 
        [[1, 2], [4, 5], [7, 8]],
        ['0:2, 1:-1'] 
      ],

      // last row
      ['offsetGet', 
        [[0, 1, 2], [3, 4, 5], [6, 7, 8]], 
        [6, 7, 8],
        ['-1:-1']
      ],
      ['offsetGet', 
        [[0, 1, 2], [3, 4, 5], [6, 7, 8]], 
        [6, 7, 8],
        ['-1']
      ],
      ['offsetGet', 
        [[0, 1, 2], [3, 4, 5], [6, 7, 8]], 
        [6, 7, 8],
        ['-1,']
      ],
      ['offsetGet', 
        [[0, 1, 2], [3, 4, 5], [6, 7, 8]], 
        [6, 7, 8],
        ['-1:-1,']
      ],
      ['offsetGet', 
        [[0, 1, 2], [3, 4, 5], [6, 7, 8]], 
        [6, 7, 8],
        ['-1:-1, :']
      ],

      // all rows & 2 first cols
      ['offsetGet', 
        [[0, 1, 2], [3, 4, 5], [6, 7, 8]], 
        [[0, 1], [3, 4], [6, 7]],
        [':,0:1']
      ],
      // all rows & 2 last cols
      ['offsetGet', 
        [[0, 1, 2], [3, 4, 5], [6, 7, 8]], 
        [[1, 2], [4, 5], [7, 8]],
        [':,1:2']
      ],
      // all rows & 2 last cols
      ['offsetGet', 
        [[0, 1, 2], [3, 4, 5], [6, 7, 8]], 
        [[1, 2], [4, 5], [7, 8]],
        [':, -2:']
      ],
      // all rows & 2 last cols
      ['offsetGet', 
        [[0, 1, 2], [3, 4, 5], [6, 7, 8]], 
        [[1, 2], [4, 5], [7, 8]],
        [':,1:-1']
      ],
      // all rows & 2 first cols
      ['offsetGet', 
        [[0, 1, 2], [3, 4, 5], [6, 7, 8]], 
        [[0, 1], [3, 4], [6, 7]],
        [':, 0:1']
      ],
      // all rows & 2 last cols
      ['offsetGet', 
        [[0, 1, 2], [3, 4, 5], [6, 7, 8]], 
        [[1, 2], [4, 5], [7, 8]],
        [':,1:2']
      ],
      // all rows & 2 last cols
      ['offsetGet', 
        [[0, 1, 2], [3, 4, 5], [6, 7, 8]], 
        [[1, 2], [4, 5], [7, 8]],
        [':,1:-1']
      ],
      
      // Point an index
      ['offsetGet', 
        np::linspace(1, 4, 4)->reshape(2, 2)->data, 
        [3, 4],
        ['1,']
      ],
      // Point a column
      ['offsetGet', 
        np::linspace(1, 4, 4)->reshape(2, 2)->data, 
        [2, 4],
        [':,1']
      ],
      // Slice all
      ['offsetGet', 
        np::linspace(1, 4, 4)->reshape(2, 2)->data,
        [[1, 2], [3, 4]],
        [':,']
      ],

      # \InvalidArgumentException
      ['offsetGet', [[[1, 2], [3, 4]]],\InvalidArgumentException::class, [',']],
      ['offsetGet', [[[1, 2], [3, 4]]],\InvalidArgumentException::class, [',1']],
      ['offsetGet', [[[1, 2], [3, 4]]],\InvalidArgumentException::class, [',:']],
      ['offsetGet', [[[1, 2], [3, 4]]],\InvalidArgumentException::class, [1.4]],
      // int:OutOfBound line
      ['offsetGet', [[[1, 2], [3, 4]]],\InvalidArgumentException::class, [1]],
      // string:OutOfBound column
      ['offsetGet', [[[1, 2], [3, 4]]],\InvalidArgumentException::class, [',4']],
      ['offsetGet', [[[1, 2], [3, 4]]],\InvalidArgumentException::class, [',:-5']],
      // string:OutOfBound line
      ['offsetGet', [[[1, 2], [3, 4]]],\InvalidArgumentException::class, ['4,']],
      ['offsetGet', [[[1, 2], [3, 4]]],\InvalidArgumentException::class, [':-5']],
      
      ['offsetGet', [[1, 2], [3, 4]],  \InvalidArgumentException::class, ['0.5'] ],
      ['offsetGet', [[1, 2], [3, 4]],  \InvalidArgumentException::class, ['hello'] ],
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
