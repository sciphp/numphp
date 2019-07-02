<?php

namespace SciPhpTest\NumPhp\Traits\Arithmetic;

use PHPUnit\Framework\TestCase;
use SciPhp\NumPhp as np;

class DotTest extends TestCase
{

    /**
     * dot(), lambda.lambda
     */
    public function testLambdaLambda()
    {
        // m & n are numeric
        $this->assertEquals(
            5*6,
            np::dot(5, 6)
        );
    }

    /**
     * dot(), lambda.array
     */
    public function testLambdaArray()
    {
        // 1-dim array
        $this->assertEquals(
            [9, 18, 27, 36],
            np::dot(9, [1, 2, 3, 4])->data,
            '1-dim array'
        );

        // 3-dim array
        $this->assertEquals(
            [[[9, 18, 27, 36]]],
            np::dot(9, [[[1, 2, 3, 4]]])->data,
            '3-dim array'
        );
    }

    /**
     * dot(), array.lambda
     */
    public function testArrayLambda()
    {
        // 1-dim array
        $this->assertEquals(
            [9, 18, 27, 36],
            np::dot([1, 2, 3, 4], 9)->data,
            '1-dim array'
        );

        // 3-dim array
        $this->assertEquals(
            [[[9, 18, 27, 36]]],
            np::dot([[[1, 2, 3, 4]]], 9)->data,
            '3-dim array'
        );
    }

    /**
     * dot(), square arrays
     */
    public function testSquareArray()
    {
        $m = np::linspace(1, 9, 9)->reshape(3, 3);
        $n = np::linspace(1, 9, 9)->reshape(3, 3);

        // m & n are NdArray's
        $this->assertEquals(
            [[ 30,    36,    42 ],
             [ 66,    81,    96 ],
             [102, 126, 150 ] ],
            np::dot($m, $n)->data
        );

        // m is NdArray, n is a PHP array
        $this->assertEquals(
            [[ 30,    36,    42 ],
             [ 66,    81,    96 ],
             [102, 126, 150 ] ],
            np::dot($m, $n->data)->data
        );

        // m is a PHP array, n is NdArray
        $this->assertEquals(
            [[ 30,    36,    42 ],
             [ 66,    81,    96 ],
             [102, 126, 150 ] ],
            np::dot($m->data, $n)->data
        );

        // m & n are PHP arrays
        $this->assertEquals(
            [[ 30,    36,    42 ],
             [ 66,    81,    96 ],
             [102, 126, 150 ] ],
            np::dot($m->data, $n->data)->data
        );
    }

    /**
     * dot(), non square arrays
     */
    public function testNonSquareArray()
    {
        $m = np::linspace(1, 6, 6)->reshape(2, 3);
        $n = np::linspace(1, 6, 6)->reshape(3, 2);

        // m.n
        $this->assertEquals(
            [[ 22, 28 ],
             [ 49, 64 ]],
            np::dot($m, $n)->data
        );

        // m(3x2).n(2x3)
        $this->assertEquals(
            [[    9, 12, 15 ],
             [ 19, 26, 33 ],
             [ 29, 40, 51 ]],
            np::dot($m->reshape(3, 2), $n->reshape(2, 3))->data
        );
    }

    /**
     * dot(), first parameter is not an array_like
     */
    public function testFirstArgumentNonArray()
    {
        $this->expectException(\InvalidArgumentException::class);

        np::dot('hello', [55]);
    }

    /**
     * dot(), second parameter is not an array_like
     */
    public function testSecondArgumentNonArray()
    {
        $this->expectException(\InvalidArgumentException::class);

        np::dot([1], 'Hello');
    }

    /**
     * Matrices are not aligned
     */
    public function testMatricesNotAligned()
    {
        $this->expectException(\InvalidArgumentException::class);

        np::dot([[1, 2, 3]], [[1, 2, 3]]);
    }

    /**
     * dot(), vector * vector
     */
    public function testVectorVector()
    {
        $m = np::linspace(1, 3, 3);
        $n = np::linspace(1, 3, 3);

        // m.n
        $this->assertEquals(
            14,
            np::dot($m, $n),
            'vector * vector'
        );
    }

    /**
     * dot(), vector * vector not aligned
     */
    public function testVectorVectorNotAligned()
    {
        $this->expectException(\InvalidArgumentException::class);

        $m = np::linspace(1, 3, 3);
        $n = np::linspace(1, 4, 4);
        np::dot($m, $n);
    }

    /**
     * dot(), vector * array
     */
    public function testVectorArray()
    {
        $m = np::linspace(1, 3, 3);
        $n = np::linspace(1, 6, 6)->reshape(3, 2);

        // m.n
        $this->assertEquals(
            [22, 28],
            np::dot($m, $n)->data,
            'vector * array'
        );
    }

    /**
     * dot(), vector * array not aligned (vector)
     */
    public function testVectorArrayNotAlignedVector()
    {
        $this->expectException(\InvalidArgumentException::class);

        $m = np::linspace(1, 3, 3);
        $n = np::linspace(1, 6, 6)->reshape(2, 3);
        np::dot($m, $n);
    }

    /**
     * dot(), vector * array not aligned (array)
     */
    public function testVectorArrayNotAlignedArray()
    {
        $this->expectException(\InvalidArgumentException::class);

        $m = np::linspace(1, 3, 3);
        $n = np::linspace(1, 6, 6)->reshape(2, 3);
        np::dot($m, $n);
    }

    /**
     * dot(), array * vector
     */
    public function testArrayVector()
    {
        $m = np::linspace(1, 6, 6)->reshape(2,3);
        $n = np::linspace(1, 3, 3);

        // m.n
        $this->assertEquals(
            [14, 32],
            np::dot($m, $n)->data,
            'array * vector'
        );
    }

    /**
     * dot(), array * vector not aligned (array)
     */
    public function testArrayVectorNotAlignedArray()
    {
        $this->expectException(\InvalidArgumentException::class);

        $m = np::linspace(1, 6, 6)->reshape(2, 3);
        $n = np::linspace(1, 2, 2);
        np::dot($m, $n);
    }

    /**
     * dot(), array * vector not aligned (vector)
     */
    public function testArrayVectorNotAlignedVector()
    {
        $this->expectException(\InvalidArgumentException::class);

        $m = np::linspace(1, 6, 6)->reshape(2, 3);
        $n = np::linspace(1, 2, 2);
        np::dot($m, $n);
    }
}
