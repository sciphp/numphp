<?php

namespace SciPhpTest\NdArray;

use PHPUnit\Framework\TestCase;
use SciPhp\NdArray;
use SciPhp\NumPhp as np;

class StringFormatterTest extends TestCase
{
  /**
   * truncate
   */
  public function testTruncate()
  {
    $m = np::arange(0, 9)->resize(20, 3);

    $expected = <<<EXPECTED
[[0    1    2  ]
 [3    4    5  ]
 [6    7    8  ]
 [0    1    2  ]
 [3    4    5  ]
 [...  ...  ...]
 [0    1    2  ]
 [3    4    5  ]
 [6    7    8  ]
 [0    1    2  ]
 [3    4    5  ]]\n
EXPECTED;

    $this->assertEquals($expected, $m->__toString());
  }


  
  /**
   * null render
   */
  public function testNull()
  {
    $v = new NdArray([1, null]);

    $expected = "[1  null]\n";
    
    $this->assertEquals($expected, $v->__toString());
  }

  /**
   * true render
   */
  public function testTrue()
  {
    $v = new NdArray([1, true]);

    $expected = "[1  true]\n";
    
    $this->assertEquals($expected, $v->__toString());
  }

  /**
   * false render
   */
  public function testFalse()
  {
    $v = new NdArray([1, false]);

    $expected = "[1  false]\n";
    
    $this->assertEquals($expected, $v->__toString());
  }

  /**
   * Empty NdArray to string
   */
  public function testEmptyArray()
  {
    $v = new NdArray([]);

    $expected = "[]\n";
    
    $this->assertEquals($expected, $v->__toString());
  }

  /**
   * Range of integers to string
   */
  public function testIntegerRange()
  {
    $v = np::linspace(1, 3, 3);

    $expected = "[1  2  3]\n";
    
    $this->assertEquals($expected, $v->__toString());
  }

  /**
   * Range of floats to string
   */
  public function testFloatRange()
  {
    $v = np::arange(1, 2, 0.2);

    $expected = "[1    1.2  1.4  1.6  1.8]\n";
    
    $this->assertEquals($expected, $v->__toString());
  }

  /**
   * 2D Matrix of integers to string
   */
  public function testInteger2DimMatrix()
  {
    $m = np::linspace(1, 9, 9)->reshape(3, 3);

    $expected = <<<EXPECTED
[[1  2  3]
 [4  5  6]
 [7  8  9]]\n
EXPECTED;
    
    $this->assertEquals($expected, $m->__toString());
  }

  /**
   * 2D Matrix of floats to string
   */
  public function testFloat2DimMatrix()
  {
    $m = np::linspace(1, 8, 9)->reshape(3, 3);

    $expected = <<<EXPECTED
[[1      1.875  2.75 ]
 [3.625  4.5    5.375]
 [6.25   7.125  8    ]]\n
EXPECTED;
    
    $this->assertEquals($expected, $m->__toString());
  }

  /**
   * 3D Matrix of integers to string
   */
  public function testInteger3DimMatrix()
  {
    $m = np::linspace(1, 9, 9)->reshape(1, 3, 3);

    $expected = <<<EXPECTED
[[[1  2  3]
  [4  5  6]
  [7  8  9]]]\n
EXPECTED;
    
    $this->assertEquals($expected, $m->__toString());
  }

  /**
   * 3D Matrix of floats to string
   */
  public function testFloat3DimMatrix()
  {
    $m = np::linspace(1, 8, 9)->reshape(1, 3, 3);

    $expected = <<<EXPECTED
[[[1      1.875  2.75 ]
  [3.625  4.5    5.375]
  [6.25   7.125  8    ]]]\n
EXPECTED;
    
    $this->assertEquals($expected, $m->__toString());
  }
}
