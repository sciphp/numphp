<?php

namespace SciPhpTest\NumPhp\Traits\Arithmetic;

use PHPUnit\Framework\TestCase;
use SciPhp\NumPhp as np;

class MultiplyTest extends TestCase
{
    /**
     * multiply(), lambda * lambda
     */
    public function testLambdaLambda()
    {
        $this->assertEquals(
            18,
            np::multiply(6, 3)
        );
    }

    /**
     * multiply(), lambda * array
     */
    public function testLambdaArray()
    {
        $this->assertEquals(
            [8, 16, 32],
            np::multiply(8, [1, 2, 4])->data
        );
    }

    /**
     * multiply(), array * lambda
     */
    public function testArrayLambda()
    {
        $this->assertEquals(
            [0, 10, 20],
            np::multiply([0, 2, 4], 5)->data
        );
    }

    /**
     * multiply(), array * array
     */
    public function testArrayArray()
    {
        $this->assertEquals(
            [[0, 4, 4]],
            np::multiply([[0, 2, 4]], [[4, 2, 1]])->data
        );
    }

    /**
     * multiply(), array * vector
     */
    public function testArrayVector()
    {
        $this->assertEquals(
            [[0, 4, 4]],
            np::multiply([[0, 2, 4]], [4, 2, 1])->data
        );
    }

    /**
     * multiply(), vector * array
     */
    public function testVectorArray()
    {
        $this->assertEquals(
            [[0, 4, 4]],
            np::multiply([0, 2, 4], [[4, 2, 1]])->data
        );
    }

    /**
     * multiply(), vector * vector
     */
    public function testVectorVector()
    {
        $this->assertEquals(
            [0, 4, 4],
            np::multiply([0, 2, 4], [4, 2, 1])->data
        );
    }

    /**
     * multiply(), First parameter is not an array_like
     */
    public function testFirstArgumentNonArray()
    {
        $this->expectException(\InvalidArgumentException::class);

        np::multiply('hello', [55]);
    }

    /**
     * multiply(), Second parameter is not an array_like
     */
    public function testSecondArgumentNonArray()
    {
        $this->expectException(\InvalidArgumentException::class);

        np::multiply([55], 'hello');
    }

    /**
     * multiply(), vector * vector not aligned
     */
    public function testVectorVectorNotAligned()
    {
        $this->expectException(\InvalidArgumentException::class);

        np::multiply([1, 2, 3], [1, 2]);
    }

    /**
     * multiply(), vector * array not aligned
     */
    public function testVectorArrayNotAligned()
    {
        $this->expectException(\InvalidArgumentException::class);

        np::multiply([1, 2, 3], [[1, 2]]);
    }
}
