<?php

namespace SciPhpTest\NumPhp\Traits\Misc;

use PHPUnit\Framework\TestCase;
use SciPhp\NumPhp as np;

class VanderTest extends TestCase
{
  /**
   * vander(), square array, default number of columns
   */
  public function testVanderSquareArray()
  {
    // Only first parameter is filled
    $this->assertEquals(
      [[1, 1, 1],
       [4, 2, 1],
       [9, 3, 1] ],
      np::vander([1, 2, 3])->data,
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
      np::vander([1, 2, 3], 3)->data,
      'Should be
      [[1, 1, 1],
       [4, 2, 1],
       [9, 3, 1]].'
    );

    // A matrix is passed as first argument
    $this->assertEquals(
      [[1, 1, 1],
       [4, 2, 1],
       [9, 3, 1] ],
      np::vander(np::ar([1, 2, 3]), 3)->data,
      'A matrix is passed as first argument should output
      [[1, 1, 1],
       [4, 2, 1],
       [9, 3, 1]].'
    );
  }

  /**
   * vander(), non square array
   */
  public function testVanderNonSquareArray()
  {
    // Output is the smallest
    $this->assertEquals(
      [[1],
       [1],
       [1] ],
      np::vander([1, 2, 3], 1)->data,
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
      np::vander([1, 2, 3], 2)->data,
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
      np::vander([1, 2, 3], 4)->data,
      'Should be
      [[1,  1, 1, 1],
       [8,  4, 2, 1],
       [27, 9, 3, 1] ].'
    );
  }

  /**
   * vander(), first parameter is not an array or NdArray
   * 
   * @expectedException \InvalidArgumentException
   */
  public function testInvalidObjectTypeAsFirstArgument()
  {
    np::vander(new \Exception);
  }

  /**
   * vander(), first parameter is not an array or NdArray
   * 
   * @expectedException \InvalidArgumentException
   */
  public function testIntObjectTypeAsFirstArgument()
  {
    np::vander(1);
  }

  /**
   * vander(), first parameter dim < 1
   * 
   * @expectedException \InvalidArgumentException
   */
  public function testSmallerDimMatrixAsFirstArgument()
  {
    np::vander([]);
  }

  /**
   * vander(), first parameter dim > 1
   * 
   * @expectedException \InvalidArgumentException
   */
  public function testLargerDimMatrixAsFirstArgument()
  {
    np::vander([[0]]);
  }

  /**
   * vander(), second parameter is a negative integer
   * 
   * @expectedException \InvalidArgumentException
   */
  public function testNegativeIntAsSecondArgument()
  {
    np::vander([1], -1);
  }

  /**
   * vander(), second parameter is a not an integer
   * 
   * @expectedException \InvalidArgumentException
   */
  public function testFloatAsSecondArgument()
  {
    np::vander([1], 1.5);
  }


}
