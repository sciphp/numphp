<?php

namespace SciPhpTest\NdArray\Traits\Arithmetic;

use PHPUnit_Framework_TestCase;
use SciPhp\NumPhp as np;

class TrilTest extends PHPUnit_Framework_TestCase
{
  /**
   * tril(), square array, offset=0
   */
  public function testSquareArray()
  {
    $m = np::linspace(1, 9, 9)->reshape(3, 3);
    
    // M 3*3, offset=0
    $this->assertEquals(
      [[1, 0, 0],
       [4, 5, 0],
       [7, 8, 9]],
      $m->tril()->data,
      'M 3*3, offset=0 should be
      [[1, 0, 0],
       [4, 5, 0],
       [7, 8, 9]].'
    );
  }

  /**
   * tril() should not modify initial matrix
   */
  public function testNonInvasive()
  {
    $m = np::linspace(1, 9, 9)->reshape(3, 3);
    $m1= $m->copy();

    $m->tril();
    
    $this->assertEquals(
      $m,
      $m1,
      'Should not modify initial matrix'
    );
  }

  /**
   * tril(), square array, positive offset
   */
  public function testSquareArrayPositiveOffset()
  {
    $m = np::linspace(1, 9, 9)->reshape(3, 3);
    
    // M 3*3, offset=1
    $this->assertEquals(
      [[1, 2, 0],
       [4, 5, 6],
       [7, 8, 9]],
      $m->tril(1)->data,
      'M 3*3, offset=1 should be
      [[1, 2, 0],
       [4, 5, 6],
       [7, 8, 9]].'
    );

    // M 3*3, offset=2
    $this->assertEquals(
      [[1, 2, 3],
       [4, 5, 6],
       [7, 8, 9]],
      $m->tril(2)->data,
      'M 3*3, offset=2 should be
      [[1, 2, 3],
       [4, 5, 6],
       [7, 8, 9]].'
    );
  }

  /**
   * tril(), square array, negative offset
   */
  public function testSquareArrayNegativeOffset()
  {
    $m = np::linspace(1, 9, 9)->reshape(3, 3);
    
    // M 3*3, offset=-1
    $this->assertEquals(
      [[0, 0, 0],
       [4, 0, 0],
       [7, 8, 0]],
      $m->tril(-1)->data,
      'M 3*3, offset=-1 should be
      [[0, 0, 0],
       [4, 0, 0],
       [7, 8, 0]].'
    );

    // M 3*3, offset=-2
    $this->assertEquals(
      [[0, 0, 0],
       [0, 0, 0],
       [7, 0, 0]],
      $m->tril(-2)->data,
      'M 3*3, offset=-2 should be
      [[0, 0, 0],
       [0, 0, 0],
       [7, 0, 0]].'
    );
  }

  /**
   * tril(), non square array, offset=0
   */
  public function testNonSquareArray()
  {
    $m = np::linspace(1, 8, 8)->reshape(4, 2);

    // M 4*2, offset=0
    $this->assertEquals(
      [[1, 0],
       [3, 4],
       [5, 6],
       [7, 8]],
      $m->tril()->data,
      'M 4*2, offset=0 should be
      [[1, 0],
       [3, 4],
       [5, 6],
       [7, 8]].'
    );

    $n = $m->reshape(2, 4);

    // M 2*4, offset=0
    $this->assertEquals(
      [[1, 0, 0, 0],
       [5, 6, 0, 0]],
      $n->tril()->data,
      'M 2*4, offset=0 should be
      [[1, 0, 0, 0],
       [5, 6, 0, 0]].'
    );
  }

  /**
   * tril(), non square array, positive offset
   */
  public function testNonSquareArrayPositiveOffset()
  {
    $m = np::linspace(1, 8, 8)->reshape(4, 2);

    // M 4*2, offset=1
    $this->assertEquals(
      [[1, 2],
       [3, 4],
       [5, 6],
       [7, 8]],
      $m->tril(1)->data,
      'M 4*2, offset=1 should be
      [[1, 2],
       [3, 4],
       [5, 6],
       [7, 8]].'
    );

    $m = $m->reshape(2, 4);

    // M 2*4, offset=1
    $this->assertEquals(
      [[1, 2, 0, 0],
       [5, 6, 7, 0]],
      $m->tril(1)->data,
      'M 2*4, offset=1 should be
      [[1, 2, 0, 0],
       [5, 6, 7, 0]].'
    );

    // M 2*4, offset=2
    $this->assertEquals(
      [[1, 2, 3, 0],
       [5, 6, 7, 8]],
      $m->tril(2)->data,
      'M 2*4, offset=2 should be
      [[1, 2, 3, 0],
       [5, 6, 7, 8]].'
    );
  }

  /**
   * tril(), non square array, negative offset
   */
  public function testNonSquareArrayNegativeOffset()
  {
    $m = np::linspace(1, 8, 8)->reshape(4, 2);

    // M 4*2, offset=-1
    $this->assertEquals(
      [[0, 0],
       [3, 0],
       [5, 6],
       [7, 8]],
      $m->tril(-1)->data,
      'M 4*2, offset=-1 should be
      [[0, 0],
       [3, 0],
       [5, 6],
       [7, 8]].'
    );

    // M 4*2, offset=-2
    $this->assertEquals(
      [[0, 0],
       [0, 0],
       [5, 0],
       [7, 8]],
      $m->tril(-2)->data,
      'M 4*2, offset=-2 should be
      [[0, 0],
       [0, 0],
       [5, 0],
       [7, 8]].'
    );

    $m = $m->reshape(2, 4);

    // M 2*4, offset=-1
    $this->assertEquals(
      [[0, 0, 0, 0],
       [5, 0, 0, 0]],
      $m->tril(-1)->data,
      'M 2*4, offset=-1 should be
      [[0, 0, 0, 0],
       [5, 0, 0, 0]].'
    );

    // M 2*4, offset=-2
    $this->assertEquals(
      [[0, 0, 0, 0],
       [0, 0, 0, 0]],
      $m->tril(-2)->data,
      'M 2*4, offset=-2 should be
      [[0, 0, 0, 0],
       [0, 0, 0, 0]].'
    );
  }

}
