<?php

namespace SciPhpTest\NdArray;

use PHPUnit\Framework\TestCase;
use SciPhp\NdArray;
use SciPhp\NumPhp as np;

class TTest extends TestCase
{
    /**
     * Tests T attribute
     */
    public function testT()
    {
      // expected / sample
      $tests = [
        [ []             , []            ],
        [ [1, 2, 3]      , [1, 2, 3]     ],
        [ [[1] ,[2], [3]], [[1, 2, 3]]   ],
        [ [[1, 4],
           [2, 5],
           [3, 6]], 
           [[1, 2, 3],
            [4, 5, 6]] 
        ],
      ];

      foreach ($tests as $test)
      {
        $this->assertEquals(
          $test[0],
          ( new NdArray($test[1]) )->T->data,
          "Should be " . print_r($test[0], true)
        );
      }
    }

    /**
     * T dim > 2
     */
    public function testDimSup2()
    {
        $this->expectException(\InvalidArgumentException::class);

        $x = np::linspace(0, 12, 12)->reshape(1, 3, 4);
        $x->T;
    }
}
