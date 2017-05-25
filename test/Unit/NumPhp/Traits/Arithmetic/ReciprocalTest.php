<?php

namespace SciPhpTest\NumPhp\Traits\Multiply;

use PHPUnit\Framework\TestCase;
use SciPhp\NumPhp as np;

class ReciprocalTest extends TestCase
{
  /**
   * reciprocal(), lambda
   */
  public function testLambda()
  {
    $this->assertEquals(
      1/6,
      np::reciprocal(6)
    );
  }

  /**
   * reciprocal(), array
   */
  public function testArray()
  {
    $this->assertEquals(
      [1, 1/2, 1/4],
      np::reciprocal([1, 2, 4])->data
    );
  }

  /**
   * reciprocal(), array
   */
  public function test2DimArray()
  {
    $this->assertEquals(
      [[1, 1/2, 1/4]],
      np::reciprocal([[1, 2, 4]])->data
    );
  }

  /**
   * reciprocal(), NdArray
   */
  public function testNdArray()
  {
    $this->assertEquals(
      [1, 1/2, 1/4],
      np::reciprocal(np::ar([1, 2, 4]))->data
    );
  }

  /**
   * reciprocal(), Parameter is not an array_like
   * 
   * @expectedException \InvalidArgumentException
   */
  public function testArgumentNonArray()
  {
    np::reciprocal('hello');
  }

  /**
   * reciprocal(), Division by zero lambda
   * 
   * @expectedException \InvalidArgumentException
   */
  public function testDivideByZeroLambda()
  {
    np::reciprocal(0);
  }
  /**
   * reciprocal(), Division by zero array
   * 
   * @expectedException \InvalidArgumentException
   */
  public function testDivideByZeroArray()
  {
    np::reciprocal([[1, 2, 3, 0]]);
  }
}
