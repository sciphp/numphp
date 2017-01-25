<?php

namespace SciPhpTest\Unit\NumPhp\Traits\Range;

use SciPhp\NdArray;
use SciPhpTest\Unit\MultiRunner;

class LinspaceTest extends MultiRunner
{
  public function getScenarios()
  {
    // method / input / expected / args
    return [
      ['linspace', 2 , [2., 2.25, 2.5, 2.75, 3.], [3, 5]                ],
      ['linspace', 2 , [2. ,  2.2,  2.4,  2.6,  2.8], [3, 5, false]       ],
      // 1 value excluding endpoint
      ['linspace', 2 , [2], [12, 1, false]       ],
      // 1 value including endpoint
      ['linspace', 2 , [12], [12, 1, true]       ],
      // 0 value
      ['linspace', 1 , [], [100, 0]       ],
      // endpoint = start
      ['linspace', 10 , [10, 10, 10, 10, 10], [10, 5]       ],
      
      // with return=true scenarios
      // 5 values including endpoint
      ['linspace', 2, [new NdArray([2., 2.25, 2.5, 2.75, 3.]), 0.25], [3, 5, true, true]  ],
      // 5 values excluding endpoint
      ['linspace', 2, [new NdArray([ 2. ,  2.2,  2.4,  2.6,  2.8]), 0.2], [3, 5, false, true]  ],
      // 1 value excluding endpoint
      ['linspace', 2, [new NdArray([2]), 10], [12, 1, false, true]  ],
      // 1 value including endpoint
      ['linspace', 2, [new NdArray([12]), 10], [12, 1, true, true]  ],
      // 0 value
      ['linspace', 1, [new NdArray([]), null], [100, 0, true, true]  ],
      // endpoint = start
      ['linspace', 10, [new NdArray([10, 10, 10, 10, 10]), 0], [10, 5, true, true]  ],

      # \InvalidArgumentException
      ['linspace', 'hello',   \InvalidArgumentException::class, ['1']         ],
      ['linspace', 2,         \InvalidArgumentException::class, ['hello']     ], 
      ['linspace', 5,         \InvalidArgumentException::class, [6, 'hello']  ], 
      ['linspace', 5,         \InvalidArgumentException::class, [6, -5]  ]
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
