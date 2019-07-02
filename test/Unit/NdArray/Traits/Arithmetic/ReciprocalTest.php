<?php

namespace SciPhpTest\NdArray\Traits\Arithmetic;

use PHPUnit\Framework\TestCase;
use SciPhp\NumPhp as np;

class ReciprocalTest extends TestCase
{
    /**
     * reciprocal(), array
     */
    public function testArray()
    {
        $this->assertEquals(
            [1, 1/2, 1/4],
            np::ar([1, 2, 4])->reciprocal()->data
        );
    }

    /**
     * reciprocal(), array
     */
    public function test2DimArray()
    {
        $this->assertEquals(
            [[1, 1/2, 1/4]],
            np::ar([[1, 2, 4]])->reciprocal()->data
        );
    }

    /**
     * reciprocal(), Division by zero array
     */
    public function testDivideByZeroArray()
    {
        $this->expectException(\InvalidArgumentException::class);

        np::ar([[1, 2, 3, 0]])->reciprocal();
    }
}
