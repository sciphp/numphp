<?php

namespace SciPhpTest\NdArray\Traits\Arithmetic;

use PHPUnit_Framework_TestCase;
use SciPhp\NdArray;
use SciPhp\NumPhp as np;

class SumTest extends PHPUnit_Framework_TestCase
{
  /**
   * sum(), 1-dim array
   */
  public function testOneDimArray()
  {
    $this->assertEquals(
      6,
      (new NdArray([0, 2, 4]))->sum()
    );
  }

  /**
   * sum(), 2-dim array
   */
  public function testTwoDimArray()
  {
    $this->assertEquals(
      30,
      np::ar([[0, 2, 4], [6, 8, 10]])->sum()
    );
  }

  /**
   * sum(), 3-dim array
   */
  public function testThreeDimArray()
  {
    $this->assertEquals(
      30,
      np::ar([[[0, 2, 4]], [[6, 8, 10]]])->sum()
    );
  }
}
