<?php

namespace SciPhpTest\NdArray\Traits\Arithmetic;

use PHPUnit\Framework\TestCase;
use SciPhp\NumPhp as np;

class TriuTest extends TestCase
{
  /**
   * triu() should not modify initial matrix
   */
  public function testNonInvasive()
  {
    $m = np::linspace(1, 9, 9)->reshape(3, 3);
    $m1= $m->copy();

    $m->triu();
    
    $this->assertEquals(
      $m,
      $m1,
      'Should not modify initial matrix'
    );
  }

  /**
   * triu(), square array, offset=0
   */
  public function testSquareArray()
  {
    $m = np::linspace(1, 9, 9)->reshape(3, 3);
    
    // M 3*3, offset=0
    $this->assertEquals(
      [[1, 2, 3],
       [0, 5, 6],
       [0, 0, 9]],
      $m->triu()->data,
      'M 3*3, offset=0 should be
      [[1, 2, 3],
       [0, 5, 6],
       [0, 0, 9]].'
    );
  }

  /**
   * triu(), square array, positive offset
   */
  public function testSquareArrayPositiveOffset()
  {
    $m = np::linspace(1, 9, 9)->reshape(3, 3);
    
    // M 3*3, offset=1
    $this->assertEquals(
      [[0, 2, 3],
       [0, 0, 6],
       [0, 0, 0]],
      $m->triu(1)->data,
      'M 3*3, offset=1 should be
      [[0, 2, 3],
       [0, 0, 6],
       [0, 0, 0]].'
    );

    // M 3*3, offset=2
    $this->assertEquals(
      [[0, 0, 3],
       [0, 0, 0],
       [0, 0, 0]],
      $m->triu(2)->data,
      'M 3*3, offset=2 should be
      [[0, 0, 3],
       [0, 0, 0],
       [0, 0, 0]].'
    );
  }

  /**
   * triu(), square array, negative offset
   */
  public function testSquareArrayNegativeOffset()
  {
    $m = np::linspace(1, 9, 9)->reshape(3, 3);
    
    // M 3*3, offset=-1
    $this->assertEquals(
      [[1, 2, 3],
       [4, 5, 6],
       [0, 8, 9]],
      $m->triu(-1)->data,
      'M 3*3, offset=-1 should be
      [[1, 2, 3],
       [4, 5, 6],
       [0, 8, 9]].'
    );

    // M 3*3, offset=-2
    $this->assertEquals(
      [[1, 2, 3],
       [4, 5, 6],
       [7, 8, 9]],
      $m->triu(-2)->data,
      'M 3*3, offset=-2 should be
      [[1, 2, 3],
       [4, 5, 6],
       [7, 8, 9]].'
    );
  }

  /**
   * triu(), non square array, offset=0
   */
  public function testNonSquareArray()
  {
    $m = np::linspace(1, 8, 8)->reshape(4, 2);

    // M 4*2, offset=0
    $this->assertEquals(
      [[1, 2],
       [0, 4],
       [0, 0],
       [0, 0]],
      $m->triu()->data,
      'M 4*2, offset=0 should be
      [[1, 2],
       [0, 4],
       [0, 0],
       [0, 0]].'
    );

    $n = $m->reshape(2, 4);

    // M 2*4, offset=0
    $this->assertEquals(
      [[1, 2, 3, 4],
       [0, 6, 7, 8]],
      $n->triu()->data,
      'M 2*4, offset=0 should be
      [[1, 2, 3, 4],
       [0, 6, 7, 8]].'
    );
  }

  /**
   * triu(), non square array, positive offsets
   */
  public function testNonSquareArrayPositiveOffset()
  {
    $m = np::linspace(1, 8, 8)->reshape(4, 2);

    // M 4*2, offset=1
    $this->assertEquals(
      [[0, 2],
       [0, 0],
       [0, 0],
       [0, 0]],
      $m->triu(1)->data,
      'M 4*2, offset=1 should be
      [[0, 2],
       [0, 0],
       [0, 0],
       [0, 0]].'
    );

    // M 4*2, offset=2
    $this->assertEquals(
      [[0, 0],
       [0, 0],
       [0, 0],
       [0, 0]],
      $m->triu(2)->data,
      'M 4*2, offset=2 should be
      [[0, 0],
       [0, 0],
       [0, 0],
       [0, 0]].'
    );

    $m = $m->reshape(2, 4);

    // M 2*4, offset=1
    $this->assertEquals(
      [[0, 2, 3, 4],
       [0, 0, 7, 8]],
      $m->triu(1)->data,
      'M 2*4, offset=1 should be
      [[0, 2, 3, 4],
       [0, 0, 7, 8]].'
    );

    // M 2*4, offset=2
    $this->assertEquals(
      [[0, 0, 3, 4],
       [0, 0, 0, 8]],
      $m->triu(2)->data,
      'M 2*4, offset=2 should be
      [[0, 0, 3, 4],
       [0, 0, 0, 8]].'
    );

    // M 2*4, offset=3
    $this->assertEquals(
      [[0, 0, 0, 4],
       [0, 0, 0, 0]],
      $m->triu(3)->data,
      'M 2*4, offset=3 should be
      [[0, 0, 0, 4],
       [0, 0, 0, 0]].'
    );
  }

  /**
   * triu(), non square array, negative offset
   */
  public function testNonSquareArrayNegativeOffset()
  {
    $m = np::linspace(1, 8, 8)->reshape(4, 2);

    // M 4*2, offset=-1
    $this->assertEquals(
      [[1, 2],
       [3, 4],
       [0, 6],
       [0, 0]],
      $m->triu(-1)->data,
      'M 4*2, offset=-1 should be
      [[1, 2],
       [3, 4],
       [0, 6],
       [0, 0]].'
    );

    // M 4*2, offset=-2
    $this->assertEquals(
      [[1, 2],
       [3, 4],
       [5, 6],
       [0, 8]],
      $m->triu(-2)->data,
      'M 4*2, offset=-2 should be
      [[1, 2],
       [3, 4],
       [5, 6],
       [0, 8]].'
    );

    // M 4*2, offset=-3
    $this->assertEquals(
      [[1, 2],
       [3, 4],
       [5, 6],
       [7, 8]],
      $m->triu(-3)->data,
      'M 4*2, offset=-3 should be
      [[1, 2],
       [3, 4],
       [5, 6],
       [7, 8]].'
    );

    $n = $m->reshape(2, 4);

    // M 2*4, offset=-1
    $this->assertEquals(
      [[1, 2, 3, 4],
       [5, 6, 7, 8]],
      $n->triu(-1)->data,
      'M 2*4, offset=-1 should be
      [[1, 2, 3, 4],
       [5, 6, 7, 8]].'
    );
  }

  /**
   * triu(), empty array
   */
  public function testEmptyMatrix()
  {
    $m = np::ar([]);

    // M 0, offset=0
    $this->assertEquals(
      [[]],
      $m->triu()->data,
      'M 0,0, offset=0 should be
      [[]].'
    );

    $m = np::ar([[]]);

    // M 1*0, offset=-1
    $this->assertEquals(
      [[]],
      $m->triu(-1)->data,
      'M 1,0, offset=0 should be
      [[]].'
    );
  }
}
