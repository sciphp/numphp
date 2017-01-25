<?php

namespace SciPhpTest\Unit\NumPhp\Traits\Range;

use SciPhpTest\Unit\MultiRunner;

class ArangeTest extends MultiRunner
{
  public function getScenarios()
  {
    // method / input / expected / args
    return [
      ['arange', 3 , [0, 1, 2]                    ],
      ['arange', -3 , [-3, -2, -1]                ],
      ['arange', 1 , [1, 2, 3], [4]               ],
      ['arange', 1 , [1, 0, -1], [-2]             ],
      ['arange', 1 , [1], [-1, -5]                ],
      ['arange', 1 , [], [1, -5]                  ],
      ['arange', 1 , [1], [2, 5]                  ],
      ['arange', 10 , [0, 2, 4, 6, 8], [null, 2]  ],
      ['arange', 0.1 , [0.1, 1.1, 2.1, 3.1], [4.6, 1, 0.00000001]  ],
      ['arange', 0 , [0.0, 0.2, 0.4, 0.6, 0.8], [1, 0.2, 0.0001]  ],

      # \InvalidArgumentException
      ['arange', 'hello',       \InvalidArgumentException::class],
      ['arange', [[1, 0]],      \InvalidArgumentException::class],
      ['arange', 5,             \InvalidArgumentException::class, [6, 'hello'] ],
      ['arange', 1,             \InvalidArgumentException::class, [2, -5]   ],
      ['arange', 1,             \InvalidArgumentException::class, [-2, 5]   ],
      ['arange', 5,             \InvalidArgumentException::class, ['hello'] ],
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
