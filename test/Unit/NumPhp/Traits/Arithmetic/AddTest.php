<?php

namespace SciPhpTest\NumPhp\Traits\Arithmetic;

use PHPUnit\Framework\TestCase;
use SciPhp\NumPhp as np;

class AddTest extends TestCase
{
    /**
     * add(), lambda + lambda
     */
    public function testAddLambdaLambda()
    {
        $this->assertEquals(
            5 + 6,
            np::add(5, 6)
        );
    }

    /**
     * add(), lambda + array
     */
    public function testAddLambdaArray()
    {
        $this->assertEquals(
            [5, 7, 9],
            np::add(5, [0, 2, 4])->data
        );
    }

    /**
     * add(), vector + vector
     */
    public function testAddVectorVector()
    {
        $this->assertEquals(
            [5, 7, 9],
            np::add([5, 5, 5], [0, 2, 4])->data
        );
    }

    /**
     * add(), vector + vector Vectors not aligned
     */
    public function testAddVectorVectorNotAlignedVector()
    {
        $this->expectException(\InvalidArgumentException::class);

        np::add([5, 5, 5], [0, 2, 4, 5]);
    }

    /**
     * add(), vector + array
     */
    public function testAddVectorArray()
    {
        $this->assertEquals(
            [[5, 7, 9]],
            np::add([5, 5, 5], [[0, 2, 4]])->data,
            'One line array'
        );

        $this->assertEquals(
            [[5, 7, 9], [11, 13, 15]],
            np::add([5, 5, 5], [[0, 2, 4], [6, 8, 10]])->data,
            '2 lines array'
        );
    }

    /**
     * add(), vector + array Vector not aligned
     */
    public function testAddVectorArrayNotAlignedVector()
    {
        $this->expectException(\InvalidArgumentException::class);

        np::add([5, 5, 5], [[0, 2, 4, 5]]);
    }

    /**
     * add(), array + vector
     */
    public function testAddArrayVector()
    {
        $this->assertEquals(
            [[5, 7, 9]],
            np::add([[0, 2, 4]], [5, 5, 5])->data
        );
    }

    /**
     * add(), array + vector Vector not aligned
     */
    public function testAddArrayVectorNotAlignedVector()
    {
        $this->expectException(\InvalidArgumentException::class);

        np::add([[0, 2, 4, 5]], [5, 5, 5]);
    }

    /**
     * add(), array + array
     */
    public function testAddArrayArray()
    {
        $this->assertEquals(
            [[1, 4, 7]],
            np::add([[0, 2, 4]], [[1, 2, 3]])->data
        );
    }

    /**
     * add(), array + array Matrices not aligned
     */
    public function testAddArrayArrayNotAlignedArrays()
    {
        $this->expectException(\InvalidArgumentException::class);

        np::add([[0, 2, 4, 5]], [[5, 5, 5]]);
    }
    
    /**
     * add(), first parameter is not an array_like
     */
    public function testAddFirstArgumentNonArray()
    {
        $this->expectException(\InvalidArgumentException::class);

        np::add('hello', [55]);
    }

    /**
     * add(), Second parameter is not an array_like
     */
    public function testAddSecondArgumentNonArray()
    {
        $this->expectException(\InvalidArgumentException::class);

        np::add([55], 'hello');
    }
}
