<?php

namespace SciPhpTest\NdArray\Traits\Attribute;

use PHPUnit\Framework\TestCase;
use SciPhp\NdArray;

class ShapeTest extends TestCase
{
  /**
   * Reshaping tests
   */
  public function getScenarios()
  {
    // input, expected / args
    return [
      [ [1, 2, 3], [1, 2, 3], [3]     ],
      [ [[1] ,[2], [3]], [[1, 2, 3]], [1, 3]   ],
      [ [[1, 2],
         [3, 4],
         [5, 6]], 
         [[1, 2, 3],
          [4, 5, 6]],
         [2, 3]
      ],
    ];
  }

  /**
   * @dataProvider getScenarios
   */
  public function testScenario($input, $expected, $args = null)
  {
    $m = new NdArray($input);
    $m->shape = $args;
    $this->assertEquals($expected, $m->data);
  }
}
