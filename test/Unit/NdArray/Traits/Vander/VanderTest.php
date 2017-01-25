<?php

namespace SciPhpTest\NdArray\Traits\Vander;

use PHPUnit_Framework_TestCase;
use SciPhp\NumPhp as np;

class VanderTest extends PHPUnit_Framework_TestCase
{
  /**
   * vander(), square array, default number of columns
   */
  public function testSquareArray()
  {
    // Only first parameter is filled
    $this->assertEquals(
      [[1, 1, 1],
       [4, 2, 1],
       [9, 3, 1] ],
      np::ar([1, 2, 3])->vander()->data,
      'Should be
      [[1, 1, 1],
       [4, 2, 1],
       [9, 3, 1]].'
    );

    // Two parameters are filled
    $this->assertEquals(
      [[1, 1, 1],
       [4, 2, 1],
       [9, 3, 1] ],
      np::ar([1, 2, 3])->vander(3)->data,
      'Should be
      [[1, 1, 1],
       [4, 2, 1],
       [9, 3, 1]].'
    );
  }

  /**
   * vander(), non square array
   */
  public function testNonSquareArray()
  {
    // Output is the smallest
    $this->assertEquals(
      [[1],
       [1],
       [1] ],
      np::ar([1, 2, 3])->vander(1)->data,
      'Should be
      [[1],
       [1],
       [1] ].'
    );

    // Output is smaller
    $this->assertEquals(
      [[1, 1],
       [2, 1],
       [3, 1] ],
      np::ar([1, 2, 3])->vander(2)->data,
      'Should be
      [[1, 1],
       [2, 1],
       [3, 1] ].'
    );

    // Output is larger
    $this->assertEquals(
      [[1,  1, 1, 1],
       [8,  4, 2, 1],
       [27, 9, 3, 1] ],
      np::ar([1, 2, 3])->vander(4)->data,
      'Should be
      [[1,  1, 1, 1],
       [8,  4, 2, 1],
       [27, 9, 3, 1] ].'
    );
  }

  /**
   * vander(), first parameter is not an int
   * 
   * @expectedException \InvalidArgumentException
   */
  public function testInvalidTypeAsFirstArgument()
  {
    np::ar([1, 2, 3])->vander([51]); 
  }

  /**
   * vander(), first parameter dim < 1
   * 
   * @expectedException \InvalidArgumentException
   */
  public function testSmallerDimMatrixAsFirstArgument()
  {
    np::ar([])->vander();
  }

  /**
   * vander(), first parameter dim > 1
   * 
   * @expectedException \InvalidArgumentException
   */
  public function testLargerDimMatrixAsFirstArgument()
  {
    np::ar([[0]])->vander();
  }

  /**
   * vander(), second parameter is a negative integer
   * 
   * @expectedException \InvalidArgumentException
   */
  public function testNegativeIntAsSecondArgument()
  {
    np::ar([1])->vander(-1);
  }

  /**
   * vander(), second parameter is a not an integer
   * 
   * @expectedException \InvalidArgumentException
   */
  public function testFloatAsSecondArgument()
  {
    np::ar([1])->vander(1.5);
  }
}
