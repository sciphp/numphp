<?php

namespace SciPhpTest\NdArray;

use PHPUnit\Framework\TestCase;
use SciPhp\NdArray;
use SciPhp\NumPhp as np;

class IndexTraitTest extends TestCase
{
  /**
   * Tests offsetUnset()
   */
  public function testOffsetUnset()
  {
    $x = np::linspace(1, 4, 4)->reshape(2, 2);

    unset($x[1]);
    $this->assertEquals($x->data, [ [1, 2] ], 'Should be [ [1, 2] ]');
    
    unset($x[42]);
    $this->assertEquals($x->data, [ [1, 2] ], 'Should be [ [1, 2] ]');
  }

  /**
   * Tests that an offset exists
   */
  public function testOffsetExists()
  {
    $x = np::linspace(1, 9, 9)->reshape(3, 3);

    $this->assertTrue(isset($x[1]), 'Should be true');

    $this->assertFalse(isset($x[42]), 'Should be false');
  }
}
