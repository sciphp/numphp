<?php

namespace SciPhpTest\NumPhp\Traits\Arithmetic;

use PHPUnit_Framework_TestCase;
use SciPhp\NumPhp as np;

class AddTest extends PHPUnit_Framework_TestCase
{

  /**
   * add(), lambda + lambda
   */
  public function testAddLambdaLambda()
  {
    $this->assertEquals(
      5 + 6,
      np::add(5, 6)
    );
  }

  /**
   * add(), lambda + array
   */
  public function testAddLambdaArray()
  {
    $this->assertEquals(
      [5, 7, 9],
      np::add(5, [0, 2, 4])->data
    );
  }

  /**
   * add(), vector + vector
   */
  public function testAddVectorVector()
  {
    $this->assertEquals(
      [5, 7, 9],
      np::add([5, 5, 5], [0, 2, 4])->data
    );
  }

  /**
   * add(), vector + vector Vectors not aligned
   * 
   * @expectedException \InvalidArgumentException
   */
  public function testAddVectorVectorNotAlignedVector()
  {
    np::add([5, 5, 5], [0, 2, 4, 5]);
  }

  /**
   * add(), vector + array
   */
  public function testAddVectorArray()
  {
    $this->assertEquals(
      [[5, 7, 9]],
      np::add([5, 5, 5], [[0, 2, 4]])->data,
      'One line array'
    );

    $this->assertEquals(
      [[5, 7, 9], [11, 13, 15]],
      np::add([5, 5, 5], [[0, 2, 4], [6, 8, 10]])->data,
      '2 lines array'
    );
  }

  /**
   * add(), vector + array Vector not aligned
   * 
   * @expectedException \InvalidArgumentException
   */
  public function testAddVectorArrayNotAlignedVector()
  {
    np::add([5, 5, 5], [[0, 2, 4, 5]]);
  }

  /**
   * add(), array + vector
   */
  public function testAddArrayVector()
  {
    $this->assertEquals(
      [[5, 7, 9]],
      np::add([[0, 2, 4]], [5, 5, 5])->data
    );
  }

  /**
   * add(), array + vector Vector not aligned
   * 
   * @expectedException \InvalidArgumentException
   */
  public function testAddArrayVectorNotAlignedVector()
  {
    np::add([[0, 2, 4, 5]], [5, 5, 5]);
  }

  /**
   * add(), array + array
   */
  public function testAddArrayArray()
  {
    $this->assertEquals(
      [[1, 4, 7]],
      np::add([[0, 2, 4]], [[1, 2, 3]])->data
    );
  }

  /**
   * add(), array + array Matrices not aligned
   * 
   * @expectedException \InvalidArgumentException
   */
  public function testAddArrayArrayNotAlignedArrays()
  {
    np::add([[0, 2, 4, 5]], [[5, 5, 5]]);
  }
  

  /**
   * add(), first parameter is not an array_like
   * 
   * @expectedException \InvalidArgumentException
   */
  public function testAddFirstArgumentNonArray()
  {
    np::add('hello', [55]);
  }

  /**
   * add(), Second parameter is not an array_like
   * 
   * @expectedException \InvalidArgumentException
   */
  public function testAddSecondArgumentNonArray()
  {
    np::add([55], 'hello');
  }
}
