<?php

namespace SciPhpTest\NdArray;

use PHPUnit\Framework\TestCase;
use SciPhp\NdArray;

class AttributeTest extends TestCase
{
    /**
     * An undefined attribute must throw an exception
     */
    public function testInvalidAttributeException()
    {
        $this->expectException(\SciPhp\Exception\InvalidAttributeException::class);

        ( new NdArray([]) )->ndimmm;
    }

    /**
     * Tests data attribute
     */
    public function testData()
    {
        // expected = sample
        $tests = [
            []                        ,
            [1, 2, 3]         ,
            [[1, 2, 3]]     ,
            [[[1, 2, 3]]]    
        ];

        foreach ($tests as $test)
        {
            $this->assertEquals(
                $test,
                ( new NdArray($test) )->data,
                "Should be " . print_r($test, true)
            );
        }
    }

    /**
     * Tests ndim attribute
     */
    public function testNdim()
    {
        // expected / sample
        $tests = [
            [ 0, []                         ],
            [ 1, [1, 2, 3]            ],
            [ 2, [[1, 2, 3]]        ],
            [ 3, [[[1, 2, 3]]]    ],
        ];

        foreach ($tests as $test)
        {
            $this->assertEquals(
                $test[0],
                ( new NdArray($test[1]) )->ndim,
                "Should be {$test[0]}"
            );
        }
    }

    /**
     * Tests size attribute
     */
    public function testSize()
    {
        // expected / sample
        $tests = [
            [ 0, []                         ],
            [ 3, [1, 2, 3]            ],
            [ 3, [[1, 2, 3]]        ],
            [ 3, [[[1, 2, 3]]]    ],
        ];

        foreach ($tests as $test)
        {
            $this->assertEquals(
                $test[0],
                ( new NdArray($test[1]) )->size,
                "Should be {$test[0]}"
            );
        }
    }

    /**
     * Tests shape attribute
     */
    public function testShape()
    {
        // expected / sample
        $tests = [
            [ [],                []                        ],
            [ [3],             [1, 2, 3]         ],
            [ [1 ,3],        [[1, 2, 3]]     ],
            [ [1, 1, 3], [[[1, 2, 3]]] ],
        ];

        foreach ($tests as $test)
        {
            $this->assertEquals(
                $test[0],
                ( new NdArray($test[1]) )->shape,
                "Should be " . print_r($test[0], true)
            );
        }
    }
}
