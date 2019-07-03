<?php

namespace SciPhpTest\NumPhp\Traits\Divide;

use PHPUnit\Framework\TestCase;
use SciPhp\NumPhp as np;

class DivideTest extends TestCase
{
    /**
     * divide(), lambda / lambda
     */
    public function testDivideLambdaLambda()
    {
        $this->assertEquals(
            2,
            np::divide(6, 3)
        );
    }

    /**
     * divide(), lambda / array
     */
    public function testDivideLambdaArray()
    {
        $this->assertEquals(
            [8, 4, 2],
            np::divide(8, [1, 2, 4])->data
        );
    }

    /**
     * divide(), array / lambda
     */
    public function testDivideArrayLambda()
    {
        $this->assertEquals(
            [0, 0.4, 0.8],
            np::divide([0, 2, 4], 5)->data
        );
    }

    /**
     * divide(), array / array
     */
    public function testDivideArrayArray()
    {
        $this->assertEquals(
            [[0, 1, 4]],
            np::divide([[0, 2, 4]], [[4, 2, 1]])->data
        );
    }

    /**
     * divide(), array / vector
     */
    public function testDivideArrayVector()
    {
        $this->assertEquals(
            [[0, 1, 4]],
            np::divide([[0, 2, 4]], [4, 2, 1])->data
        );
    }

    /**
     * divide(), vector / array
     */
    public function testDivideVectorArray()
    {
        $this->assertEquals(
            [[0, 1, 4]],
            np::divide([0, 2, 4], [[4, 2, 1]])->data
        );
    }

    /**
     * divide(), matrix / matrix with broadcast
     */
    public function testDivideMatrixMatrixBroadcast()
    {
        $this->assertEquals(
[[1,                2,                3              ],
 [2,                2.5,              3              ],
 [2.3333333333333,  2.6666666666667,  3              ]]
,
            np::divide(
                np::linspace(1, 9, 9)->reshape(3, 3),
                [[1], [2], [3]]
            )->data
        );
    }

    /**
     * divide(), First parameter is not an array_like
     */
    public function testDivideFirstArgumentNonArray()
    {
        $this->expectException(\InvalidArgumentException::class);

        np::divide('hello', [55]);
    }

    /**
     * divide(), Second parameter is not an array_like
     */
    public function testDivideSecondArgumentNonArray()
    {
        $this->expectException(\InvalidArgumentException::class);

        np::divide([55], 'hello');
    }

    /**
     * divide(), Second parameter is 0
     */
    public function testDivideSecondArgumentNull()
    {
        $this->expectException(\InvalidArgumentException::class);

        np::divide([55], 0);
    }

    /**
     * divide(), Second parameter is a matrix with at 
     * least one zero inside
     */
    public function testDivideSecondArgumentIsVectorWith0()
    {
        $this->expectException(\InvalidArgumentException::class);

        np::divide([55, 1, 1], [1, 1, 0]);
    }

    /**
     * divide(), Second parameter is a vector with at 
     * least one null inside
     */
    public function testDivideSecondArgumentIsVectorWithNull()
    {
        $this->expectException(\InvalidArgumentException::class);

        np::divide([55, 1, 1], [1, 1, 0]);
    }

    /**
     * divide(), vector / vector not aligned
     */
    public function testDivideVectorVectorNotAligned()
    {
        $this->expectException(\InvalidArgumentException::class);

        np::divide([1, 2, 3], [1, 2]);
    }
}
