<?php

namespace SciPhpTest\NumPhp\Traits\Multiply;

use PHPUnit\Framework\TestCase;
use SciPhp\NumPhp as np;

class ReciprocalTest extends TestCase
{
    /**
     * reciprocal(), lambda
     */
    public function testLambda()
    {
        $this->assertEquals(
            1/6,
            np::reciprocal(6)
        );
    }

    /**
     * reciprocal(), array
     */
    public function testArray()
    {
        $this->assertEquals(
            [1, 1/2, 1/4],
            np::reciprocal([1, 2, 4])->data
        );
    }

    /**
     * reciprocal(), array
     */
    public function test2DimArray()
    {
        $this->assertEquals(
            [[1, 1/2, 1/4]],
            np::reciprocal([[1, 2, 4]])->data
        );
    }

    /**
     * reciprocal(), NdArray
     */
    public function testNdArray()
    {
        $this->assertEquals(
            [1, 1/2, 1/4],
            np::reciprocal(np::ar([1, 2, 4]))->data
        );
    }

    /**
     * reciprocal(), Parameter is not an array_like
     */
    public function testArgumentNonArray()
    {
        $this->expectException(\InvalidArgumentException::class);

        np::reciprocal('hello');
    }

    /**
     * reciprocal(), Division by zero lambda
     */
    public function testDivideByZeroLambda()
    {
        $this->expectException(\InvalidArgumentException::class);

        np::reciprocal(0);
    }

    /**
     * reciprocal(), Division by zero array
     */
    public function testDivideByZeroArray()
    {
        $this->expectException(\InvalidArgumentException::class);

        np::reciprocal([[1, 2, 3, 0]]);
    }
}
