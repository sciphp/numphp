<?php

namespace SciPhpTest\NumPhp\Traits\Arithmetic;

use PHPUnit\Framework\TestCase;
use SciPhp\NumPhp as np;

class SubtractTest extends TestCase
{
    /**
     * subtract(), lambda - lambda
     */
    public function testLambdaLambda()
    {
        $this->assertEquals(
            5 - 6,
            np::subtract(5, 6)
        );
    }

    /**
     * subtract(), lambda - array
     */
    public function testLambdaArray()
    {
        $this->assertEquals(
            [5, 3, 1],
            np::subtract(5, [0, 2, 4])->data
        );
    }

    /**
     * subtract(), array - lambda
     */
    public function testArrayLambda()
    {
        $this->assertEquals(
            [-5, -3, -1],
            np::subtract([0, 2, 4], 5)->data
        );
    }

    /**
     * subtract(), array - array
     */
    public function testArrayArray()
    {
        $this->assertEquals(
            [[-4, 0, 4]],
            np::subtract([[0, 2, 4]], [[4, 2, 0]])->data
        );
    }

    /**
     * subtract(), array - vector
     */
    public function testArrayVector()
    {
        $this->assertEquals(
            [[-4, 0, 4]],
            np::subtract([[0, 2, 4]], [4, 2, 0])->data
        );
    }

    /**
     * subtract(), vector - array
     */
    public function testVectorArray()
    {
        $this->assertEquals(
            [[-4, 0, 4]],
            np::subtract([0, 2, 4], [[4, 2, 0]])->data
        );
    }

    /**
     * subtract(), First parameter is not an array_like
     */
    public function testFirstArgumentNonArray()
    {
        $this->expectException(\InvalidArgumentException::class);

        np::subtract('hello', [55]);
    }

    /**
     * subtract(), Second parameter is not an array_like
     */
    public function testSecondArgumentNonArray()
    {
        $this->expectException(\InvalidArgumentException::class);

        np::subtract([55], 'hello');
    }

    /**
     * subtract(), array - array, not aligned
     */
    public function testArrayArrayNotAligned()
    {
        $this->expectException(\InvalidArgumentException::class);

        np::subtract([[55, 10]], [[1, 2, 3]]);
    }

    /**
     * subtract(), vector - vector, not aligned
     */
    public function testVectoVectorNotAligned()
    {
        $this->expectException(\InvalidArgumentException::class);

        np::subtract([55, 10], [1, 2, 3]);
    }
}
