<?php

namespace SciPhpTest\NumPhp\Traits\Operation;

use PHPUnit_Framework_TestCase;
use SciPhp\NumPhp as np;

class SumTest extends PHPUnit_Framework_TestCase
{
  /**
   * sum(), lambda
   */
  public function testLambda()
  {
    $this->assertEquals(
      6,
      np::sum(6)
    );
  }

  /**
   * sum(), 1-dim array
   */
  public function testOneDimArray()
  {
    $this->assertEquals(
      6,
      np::sum([0, 2, 4])
    );
  }

  /**
   * sum(), 2-dim array
   */
  public function testTwoDimArray()
  {
    $this->assertEquals(
      30,
      np::sum([[0, 2, 4], [6, 8, 10]])
    );
  }

  /**
   * sum(), 3-dim array
   */
  public function testThreeDimArray()
  {
    $this->assertEquals(
      30,
      np::sum([[[0, 2, 4]], [[6, 8, 10]]])
    );
  }

  /**
   * Invalid argument
   * 
   * @expectedException \InvalidArgumentException
   */
  public function testInvalidArgumentException()
  {
    np::sum('hello');
  }
}
