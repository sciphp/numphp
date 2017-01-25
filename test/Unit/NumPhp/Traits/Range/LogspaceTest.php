<?php

namespace SciPhpTest\Unit\NumPhp\Traits\Range;

use SciPhpTest\Unit\MultiRunner;

class LogspaceTest extends MultiRunner
{
  public function getScenarios()
  {
    // method / input / expected / args
    return [
      ['logspace', 2 , [100, 1000, 10000, 100000], [5, 4]       ],
      ['logspace', 2 , 
        [100, 562.34132519035, 3162.2776601684, 17782.794100389], 
        [5, 4, false]
      ],
      ['logspace', 2 , [4, 8, 16, 32], [5, 4, true, 2]          ],

      # \InvalidArgumentException
      ['logspace', 'hello',   \InvalidArgumentException::class, ['1']         ],
      ['logspace', 2,         \InvalidArgumentException::class, ['hello']     ], 
      ['logspace', 5,         \InvalidArgumentException::class, [6, 'hello']  ]
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
