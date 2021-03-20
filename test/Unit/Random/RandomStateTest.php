<?php

namespace SciPhpTest\Unit\NumPhp\LinAlg;

use SciPhp\NdArray;
use SciPhp\NumPhp as np;
use SciPhpTest\Unit\MultiRunner;

class RandomStateTest extends MultiRunner
{
    /**
     * Test that a call with no argument returns a float value
     */
    public function test_float_value()
    {
        $ret = np::random()->randn();
        $this->assertIsFloat($ret);
    }

    /**
     * Test that a call with arguments returns a NdArray with good shape
     * and that all values are float
     */    
    public function test_shaped()
    {
        $m = np::random()->randn(2, 2);
        $this->assertInstanceOf(NdArray::class, $m);
        $this->assertEquals([2, 2], $m->shape);

        foreach ($m->ravel()->data as $value) {
            $this->assertIsFloat($value);
        }
    }
}
