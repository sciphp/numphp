<?php

namespace SciPhpTest\NdArray;

use PHPUnit\Framework\TestCase;
use SciPhp\NdArray;

class ArithmeticTraitTest extends TestCase
{
    /**
     * add() $input is not an array_like
     */
    public function testInvalidInputType()
    {
        $this->expectException(\InvalidArgumentException::class);

        ( new NdArray([1]) )->add('test');
    }

    /**
     * add() $input has too many dimensions
     */
    public function testInputTooManyDimensions()
    {
        $this->expectException(\InvalidArgumentException::class);

        ( new NdArray([[1]]) )->add([[[1]]]);
    }

    /**
     * add() self has too many dimensions
     */
    public function testSelfTooManyDimensions()
    {
        $this->expectException(\InvalidArgumentException::class);

        ( new NdArray([[[1]]]) )->add([[1]]);
    }

    /**
     * add() Add an array
     */
    public function testAddArray()
    {
        $this->assertEquals(
                [[1, 3, 5]],
                ( new NdArray([[1, 2, 3]]) )->add([[0, 1, 2]])->data
        );
    }

    /**
     * dot() self.array
     */
    public function testDotArray()
    {
        $this->assertEquals(
                [16, 22],
                ( new NdArray([1, 2, 3]) )
                    ->dot(
                        [[0, 1], 
                         [2, 3],
                         [4, 5]]
                    )
                    ->data
        );
    }
}
