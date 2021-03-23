<?php

namespace SciPhpTest\Unit\NumPhp\LinAlg;

use SciPhp\NdArray;
use SciPhp\NumPhp as np;
use SciPhpTest\Unit\MultiRunner;

class RandTest extends MultiRunner
{
    /**
     * Test that a call with no argument throws an exception
     */
    public function test_no_argument_call()
    {
        $this->expectException(\InvalidArgumentException::class);

        $ret = np::random()->rand();
    }

    /**
     * Test that a call with tuple arguments returns a NdArray with
     * good shape and that all values are float between 0 and 1.
     */    
    public function test_shaped_with_tuple()
    {
        $m = np::random()->rand(2, 2);
        $this->assertInstanceOf(NdArray::class, $m);
        $this->assertEquals([2, 2], $m->shape);

        foreach ($m->ravel()->data as $value) {
            $this->assertIsFloat($value);
            $this->assertGreaterThanOrEqual(0, $value);
            $this->assertLessThanOrEqual(1, $value);
        }
    }

    /**
     * Test that a call with array arguments returns a NdArray with
     * good shape and that all values are float between 0 and 1.
     */    
    public function test_shaped_with_array()
    {
        $m = np::random()->rand([3, 3, 3]);
        $this->assertInstanceOf(NdArray::class, $m);
        $this->assertEquals([3, 3, 3], $m->shape);

        foreach ($m->ravel()->data as $value) {
            $this->assertIsFloat($value);
            $this->assertGreaterThanOrEqual(0, $value);
            $this->assertLessThanOrEqual(1, $value);
        }
    }
}
