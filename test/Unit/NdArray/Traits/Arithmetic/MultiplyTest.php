<?php

namespace SciPhpTest\NdArray\Traits\Arithmetic;

use PHPUnit_Framework_TestCase;
use SciPhp\NumPhp as np;

class MultiplyTest extends PHPUnit_Framework_TestCase
{
  /**
   * multiply(), lambda
   */
  public function testLambda()
  {
    $this->assertEquals(
      [0, 10, 20],
      np::ar([0, 2, 4])->multiply(5)->data
    );
  }

  /**
   * multiply(), array
   */
  public function testArray()
  {
    $this->assertEquals(
      [0, 8, 8],
      np::ar([0, 2, 4])->multiply([0, 4, 2])->data
    );
  }
}
