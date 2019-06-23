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
     * divide(), First parameter is not an array_like
     * 
     * @expectedException \InvalidArgumentException
     */
    public function testDivideFirstArgumentNonArray()
    {
        np::divide('hello', [55]);
    }

    /**
     * divide(), Second parameter is not an array_like
     * 
     * @expectedException \InvalidArgumentException
     */
    public function testDivideSecondArgumentNonArray()
    {
        np::divide([55], 'hello');
    }

    /**
     * divide(), Second parameter is 0
     * 
     * @expectedException \InvalidArgumentException
     */
    public function testDivideSecondArgumentNull()
    {
        np::divide([55], 0);
    }

    /**
     * divide(), Second parameter is a matrix with at 
     * least one zero inside
     * 
     * @expectedException \InvalidArgumentException
     */
    public function testDivideSecondArgumentIsVectorWith0()
    {
        np::divide([55, 1, 1], [1, 1, 0]);
    }

    /**
     * divide(), Second parameter is a vector with at 
     * least one null inside
     * 
     * @expectedException \InvalidArgumentException
     */
    public function testDivideSecondArgumentIsVectorWithNull()
    {
        np::divide([55, 1, 1], [1, 1, 0]);
    }

    /**
     * divide(), vector / vector not aligned
     * 
     * @expectedException \InvalidArgumentException
     */
    public function testDivideVectorVectorNotAligned()
    {
        np::divide([1, 2, 3], [1, 2]);
    }
}
