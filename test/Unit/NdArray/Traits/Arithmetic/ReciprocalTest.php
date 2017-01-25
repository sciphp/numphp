<?php

namespace SciPhpTest\NdArray\Traits\Arithmetic;

use PHPUnit_Framework_TestCase;
use SciPhp\NumPhp as np;

class ReciprocalTest extends PHPUnit_Framework_TestCase
{
  /**
   * reciprocal(), array
   */
  public function testArray()
  {
    $this->assertEquals(
      [1, 1/2, 1/4],
      np::ar([1, 2, 4])->reciprocal()->data
    );
  }

  /**
   * reciprocal(), array
   */
  public function test2DimArray()
  {
    $this->assertEquals(
      [[1, 1/2, 1/4]],
      np::ar([[1, 2, 4]])->reciprocal()->data
    );
  }

  /**
   * reciprocal(), Division by zero array
   * 
   * @expectedException \InvalidArgumentException
   */
  public function testDivideByZeroArray()
  {
    np::ar([[1, 2, 3, 0]])->reciprocal();
  }
}
