<?php

namespace SciPhpTest\NdArray;

use PHPUnit\Framework\TestCase;
use SciPhp\NdArray;
use SciPhp\NumPhp as np;

class ShapeTraitTest extends TestCase
{
    /**
     * resize() should not modify array
     */
    public function testResizeAlteration()
    {
        $m1 = np::ar([1, 2, 3, 4]);
        $m2 = $m1->resize(4, 4);

        $this->assertEquals(
                [1, 2, 3, 4],
                $m1->data, 
                'Array has been altered.' 
        );
    }

    /**
     * resize() as reshape (nsize preservation)
     */
    public function testResizeAsReshape()
    {
        $m = np::ar([1, 2, 3, 4])->resize(2, 2);

        $this->assertEquals(
                [[1, 2], [3, 4]],
                $m->data, 
                'Array has been resized as reshape().' 
        );
    }

    /**
     * resize() with nsize > initial nsize
     */
    public function testResizeAsHigher()
    {
        $m = np::ar([1, 2, 3, 4])->resize(4, 4);

        $this->assertEquals(
                [[1, 2, 3, 4],
                 [1, 2, 3, 4],
                 [1, 2, 3, 4],
                 [1, 2, 3, 4]],
                $m->data, 
                'Array nsize has increased.' 
        );
    }

    /**
     * resize() with nsize < initial nsize
     */
    public function testResizeAsLower()
    {
        $m = np::ar([1, 2, 3, 4])->resize(2, 1);

        $this->assertEquals(
                [[1], [2]],
                $m->data, 
                'Array nsize has decreased.' 
        );
    }

    /**
     * An attempt to reshape with different size
     */
    public function testNotAllowedReshaping()
    {
        $this->expectException(\InvalidArgumentException::class);

        ( new NdArray([2, 3, 4, 5]) )->reshape(2, 3);
    }

    /**
     * ravel()
     */
    public function testRavel()
    {
        $tests = [
            #1
            [ [1, 2, 3],
                [1, 2, 3], 
                '1 dim: Should be [1, 2, 3]' ],
            #2
            [ [ [1, 2, 3], 
                    [4, 5, 6] ],
                    [1, 2, 3, 4, 5, 6], 
                    '2 dim: Should be [1, 2, 3, 4, 5, 6]' ],
            #3
            [ [[[1, 2, 3], 
                    [4, 5, 6],
                    [7, 8, 9] ]],
                    [1, 2, 3, 4, 5, 6, 7, 8, 9],
                    '3 dim: Should be [1, 2, 3, 4, 5, 6, 7, 8, 9]' ]
        ];
        
        foreach ($tests as $test)
        {
            $this->assertEquals(
                ( new NdArray($test[0]) )->ravel()->data,
                $test[1],
                $test[2]
            );
        }
    }

    /**
     * reshape()
     */
    public function testReshape()
    {
        #1: 1 dim -> 2 dim, A tuple-like shape
        $this->assertEquals(
                [[1, 2], [3, 4]], 
                np::ar([1, 2, 3, 4])->reshape(2, 2)->data,
                '1 dim: Should be [[1, 2], [3, 4]]' 
        );

        # 1 dim -> 4 dim, An array-like shape
        $this->assertEquals(
                [ [[[1, 2], [3, 4], [5, 6], [7, 8]]] ],
                np::linspace(1, 8, 8)->reshape([1, 1, 4, 2])->data,
                '4 dim: Should be [[[[1, 2], [3, 4], [5, 6], [7, 8]]]]' 
        );

        # Matrix 4*2 -> Matrix 2*4
        $this->assertEquals(
                [[1, 2, 3, 4], [5, 6, 7, 8]], 
                np::ar([[1, 2], [3, 4], [5, 6], [7, 8]])->reshape(2, 4)->data,
                'M4*2 -> M2*4: Should be [[1, 2, 3, 4], [5, 6, 7, 8]]' 
        );
    }

    /**
     * reshape() should not modify array
     */
    public function testReshapeAlteration()
    {
        $m1 = np::ar([1, 2, 3, 4]);
        $m2 = $m1->copy();

        $this->assertTrue(
                $m1->data === $m2->data, 
                'Arrays are equivalent' 
        );

        # reshaping
        $m2->reshape(2, 2);

        $this->assertTrue(
                $m1->data === $m2->data, 
                'Arrays should not be different' 
        );
        
        $m2->reshape(2, 2);

        $this->assertTrue(
                $m1->data === $m2->data, 
                'Arrays should not be different' 
        );
        
    }
}
