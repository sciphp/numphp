<?php

namespace SciPhpTest\NdArray;

use PHPUnit_Framework_TestCase;
use SciPhp\NdArray;
use SciPhp\NumPhp as np;

class BasicTraitTest extends PHPUnit_Framework_TestCase
{
  /**
   * copy() should modify array
   */
  public function testCopyAlteration()
  {
    # power only alters the copy arrays
    $m = np::ar([1, 2, 3, 4]);
    $m->copy()->power(2);

    $this->assertEquals(
      [1, 2, 3, 4],
      $m->data, 
      'Arrays are equivalent' 
    );
  }

  /**
   * copy() copied data are the same
   */
  public function testCopyData()
  {
    # power only alters the copy arrays
    $m = np::ar([1, 2, 3, 4]);
    $m->copy();

    $this->assertEquals(
      $m->data,
      $m->copy()->data, 
      'Arrays are equivalent' 
    );
  }
}
