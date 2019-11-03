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
}
