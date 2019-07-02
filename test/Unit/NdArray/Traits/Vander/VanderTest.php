<?php

namespace SciPhpTest\NdArray\Traits\Vander;

use PHPUnit\Framework\TestCase;
use SciPhp\NumPhp as np;

class VanderTest extends TestCase
{
    /**
     * vander(), square array, default number of columns
     */
    public function testSquareArray()
    {
        // Only first parameter is filled
        $this->assertEquals(
            [[1, 1, 1],
             [4, 2, 1],
             [9, 3, 1] ],
            np::ar([1, 2, 3])->vander()->data,
            'Should be
            [[1, 1, 1],
             [4, 2, 1],
             [9, 3, 1]].'
        );

        // Two parameters are filled
        $this->assertEquals(
            [[1, 1, 1],
             [4, 2, 1],
             [9, 3, 1] ],
            np::ar([1, 2, 3])->vander(3)->data,
            'Should be
            [[1, 1, 1],
             [4, 2, 1],
             [9, 3, 1]].'
        );
    }

    /**
     * vander(), non square array
     */
    public function testNonSquareArray()
    {
        // Output is the smallest
        $this->assertEquals(
            [[1],
             [1],
             [1] ],
            np::ar([1, 2, 3])->vander(1)->data,
            'Should be
            [[1],
             [1],
             [1] ].'
        );

        // Output is smaller
        $this->assertEquals(
            [[1, 1],
             [2, 1],
             [3, 1] ],
            np::ar([1, 2, 3])->vander(2)->data,
            'Should be
            [[1, 1],
             [2, 1],
             [3, 1] ].'
        );

        // Output is larger
        $this->assertEquals(
            [[1,    1, 1, 1],
             [8,    4, 2, 1],
             [27, 9, 3, 1] ],
            np::ar([1, 2, 3])->vander(4)->data,
            'Should be
            [[1,    1, 1, 1],
             [8,    4, 2, 1],
             [27, 9, 3, 1] ].'
        );
    }

    /**
     * vander(), first parameter is not an int
     */
    public function testInvalidTypeAsFirstArgument()
    {
        $this->expectException(\InvalidArgumentException::class);

        np::ar([1, 2, 3])->vander([51]); 
    }

    /**
     * vander(), first parameter dim < 1
     */
    public function testSmallerDimMatrixAsFirstArgument()
    {
        $this->expectException(\InvalidArgumentException::class);

        np::ar([])->vander();
    }

    /**
     * vander(), first parameter dim > 1
     */
    public function testLargerDimMatrixAsFirstArgument()
    {
        $this->expectException(\InvalidArgumentException::class);

        np::ar([[0]])->vander();
    }

    /**
     * vander(), second parameter is a negative integer
     */
    public function testNegativeIntAsSecondArgument()
    {
        $this->expectException(\InvalidArgumentException::class);

        np::ar([1])->vander(-1);
    }

    /**
     * vander(), second parameter is a not an integer
     */
    public function testFloatAsSecondArgument()
    {
        $this->expectException(\InvalidArgumentException::class);

        np::ar([1])->vander(1.5);
    }
}
