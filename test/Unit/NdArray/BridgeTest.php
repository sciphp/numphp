<?php

namespace SciPhpTest\Unit\NdArray\Traits\Operation;

use SciPhpTest\Unit\MultiRunner;
use SciPhp\NdArray;
use SciPhp\NumPhp as np;

class BridgeTest extends MultiRunner
{
    public function getScenarios()
    {
        // scenario => [method / input / expected / args]
        return [
            // --- trapz() ---
            'trapz:1-dim array' => ['trapz', [1, 2, 3], 4],
            'trapz:2-dim array' => ['trapz', [[1, 0]],      \InvalidArgumentException::class],

            // --- sum() ---
            'sum:0-dim' => ['sum', [], 0                                              ], # 0 dim
            'sum:0-dim-pseudo-2-dim' => ['sum', [[]], 0                               ], # 0 dim
            'sum:1-dim' => ['sum', [0, 2, 4], 6                                       ], # 1 dim with values
            'sum:2-dim' => ['sum', [[0, 2, 4], [6, 8, 10]], 30                        ], # 2 dim
            'sum:3-dim' => ['sum', [[[0, 2, 4]], [[6, 8, 10]]], 30                    ], # 3 dim
            'sum:3 dim keepdims = true' => ['sum', [[[0, 2, 4]], [[6, 8, 10]]], [[[30]]], [null, true]], # 3 dim keepdims = true

            # Sum over axis
            'sum:2-dim Axis 0' => ['sum', [[0, 1], [0, 5], [2, 0]], [2, 6], [0]       ], # Axis 0
            'sum:2-dim Axis 1' => ['sum', [[0, 1], [0, 5], [2, 0]], [1, 5, 2], [1]    ], # Axis 1

            # Sum over axis and keepdims = true
            'sum:2-dim Axis 0 keepdims = true' => ['sum', [[0, 1], [0, 5], [2, 0]], [[2, 6]], [0, true]       ], # Axis 0 keepdims = true
            'sum:2-dim Axis 1 keepdims = true' => ['sum', [[0, 1], [0, 5], [2, 0]], [[1], [5], [2]], [1, true]], # Axis 1 keepdims = true

            // --- log2() ---
            'log2:1-dim' => ['log2', [1, 2, 3, 4],   [0, 1, 1.5849625007212, 2]],
            'log2:2-dim' => ['log2', [[1, 2, 3, 4]], [[0, 1, 1.5849625007212, 2]]],

            # \InvalidArgumentException
            'log2:1-dim-value 0'   => ['log2', [1, 0, 1],           \InvalidArgumentException::class],
            'log2:2-dim-value 0'   => ['log2', [[1, 2], [0, 1]],    \InvalidArgumentException::class],
            'log2:1-dim with null' => ['log2', [1, null, 1],        \InvalidArgumentException::class],
            'log2:2-dim with null' => ['log2', [[1, 2], [null, 1]], \InvalidArgumentException::class],

            // --- log10() ---
            'log10:1-dim' => ['log10', [1, 10, 100, 1000],   [0, 1, 2, 3]],
            'log10:2-dim' => ['log10', [[1, 10, 100, 1000]], [[0, 1, 2, 3]]],

            # \InvalidArgumentException
            'log10:1-dim with 0'    => ['log10', [1, 0, 1],           \InvalidArgumentException::class],
            'log10:2-dim with 0'    => ['log10', [[1, 2], [0, 1]],    \InvalidArgumentException::class],
            'log10:1-dim with null' => ['log10', [1, null, 1],        \InvalidArgumentException::class],
            'log10:2-dim with null' => ['log10', [[1, 2], [null, 1]], \InvalidArgumentException::class],

            // --- log() ---
            'log:1-dim' => ['log', [1, 2, 4], [0, 0.69314718055995, 1.3862943611199]],
            'log:2-dim' => ['log', [[1, 2, 4], [4, 2, 1]], [[0, 0.69314718055995, 1.3862943611199], 
                                                            [1.3862943611199, 0.69314718055995, 0]]],
            'log:1-dim exact values' => ['log', [1, M_E, M_E ** 2, M_E ** 3], [0, 1, 2, 3]],
            'log:2-dim base 100'     => ['log', np::ar([1, 100, 100 ** 2])->vander()->data, [[0, 0, 0],
                                                           [2, 1, 0],
                                                           [4, 2, 0]], [100]],
            'log:2-dim exact values' => ['log', [[1, M_E, M_E ** 2, M_E ** 3]], [[0, 1, 2, 3]]],

            # \InvalidArgumentException
            'log:1-dim base 0'    => ['log', [1, 1, 1],          \InvalidArgumentException::class, [0]],
            'log:1-dim base null' => ['log', [1, 1, 1],          \InvalidArgumentException::class, [null]],
            'log:1-dim base bool' => ['log', [1, 1, 1],          \InvalidArgumentException::class, [false]],
            'log:1-dim with 0'    => ['log', [1, 0, 1],          \InvalidArgumentException::class],
            'log:2-dim with 0'    => ['log', [[1, 2], [0, 1]],   \InvalidArgumentException::class],
            'log:1-dim with null' => ['log', [1, null, 1],       \InvalidArgumentException::class],
            'log:2-dim with null' => ['log', [[1, 2], [null, 1]],\InvalidArgumentException::class],

            // --- trace() ---
            'trace:1-dim' => ['trace', [0, 1], 0],
            'trace:2-dim' => ['trace', [[0, 1]], 0],
            'trace:2-dim offset 0'  => ['trace', [[0, 1], [1, 0]], 0],
            'trace:2-dim offset 1'  => ['trace', [[0, 1], [1, 0]], 1, [1]],
            'trace:2-dim offset -1' => ['trace', [[0, 1], [1, 0]], 1, [-1]],
            'trace:3-dim' => ['trace', np::linspace(1, 9, 9)->reshape(3, 3),  15 ],

            # \InvalidArgumentException
            'trace:3-dim' => ['trace', [[[1, 2], [3, 4]]],\InvalidArgumentException::class],
            'trace:2-dim float offset' => ['trace', [[1, 2], [3, 4]],  \InvalidArgumentException::class, [0.5] ],
            'trace:2-dim string offset' => ['trace', [[1, 2], [3, 4]],  \InvalidArgumentException::class, ['hello'] ],

            // --- copysign() ---
            'copysign:vector lambda' => ['copysign', [1, 0, -1], [-1, 0, -1], [ -1 ]],
            'copysign:2-dim array lambda' => ['copysign', [[1, 0, -1]], [[-1, 0, -1]], [ -1 ]],
            'copysign:vector vector' => ['copysign', [1, 0, -1], [-1, 0, 1], [ [-1, 0, 1] ]],
            'copysign:vector array' => ['copysign', [1, 0, -1], [[-1, 0, 1]], [ [[-1, 0, 1]] ]],
            'copysign:vector NdArray' => ['copysign', [1, 0, -1], [[-1, 0, 1]], [ new NdArray([[-1, 0, 1]]) ]],
            'copysign:array vector' => ['copysign', [[1, 0, -1]], [[-1, 0, 1]], [ [-1, 0, 1] ]],

            # \InvalidArgumentException
            'copysign:not-aligned matrices 1x2 1x3' => ['copysign', [[1, 0]],      \InvalidArgumentException::class, [ [[1, 0, -1]]  ] ],
            'copysign:not-aligned matrices 1x3 1x2' => ['copysign', [[1, 0, -1]],  \InvalidArgumentException::class, [ [[0, -1]]     ] ],
            'copysign:not-aligned matrices-3 2' => ['copysign', [1, 0, -1],    \InvalidArgumentException::class, [ [0, -1]       ] ],

            // --- signbit() ---
            'signbit:1-dim' => ['signbit', [-1, 1], [true, false]],
            'signbit:2-dim' => ['signbit', [[-1, 1], [1, -1]], [[true, false], [false, true]]],

            // --- tril() ---
            # square
            'tril:3x3 offset=0'  => ['tril', np::linspace(1, 9, 9)->reshape(3, 3)->data, [[1, 0, 0], [4, 5, 0], [7, 8, 9]]],
            'tril:3x3 offset=1'  => ['tril', np::linspace(1, 9, 9)->reshape(3, 3)->data, [[1, 2, 0], [4, 5, 6], [7, 8, 9]], [1]],
            'tril:3x3 offset=2'  => ['tril', np::linspace(1, 9, 9)->reshape(3, 3)->data, [[1, 2, 3], [4, 5, 6], [7, 8, 9]], [2]],
            'tril:3x3 offset=-1' => ['tril', np::linspace(1, 9, 9)->reshape(3, 3)->data, [[0, 0, 0], [4, 0, 0], [7, 8, 0]], [-1]],
            'tril:3x3 offset=-2' => ['tril', np::linspace(1, 9, 9)->reshape(3, 3)->data, [[0, 0, 0], [0, 0, 0], [7, 0, 0]], [-2]],
            # non square
            'tril:4x2 offset=0'  => ['tril', np::linspace(1, 8, 8)->reshape(4, 2)->data, [[1, 0], [3, 4], [5, 6], [7, 8]]],
            'tril:2x4 offset=0'  => ['tril', np::linspace(1, 8, 8)->reshape(2, 4)->data, [[1, 0, 0, 0], [5, 6, 0, 0]]],
            'tril:4x2 offset=1'  => ['tril', np::linspace(1, 8, 8)->reshape(4, 2)->data, [[1, 2], [3, 4], [5, 6], [7, 8]], [1]],
            'tril:2x4 offset=1'  => ['tril', np::linspace(1, 8, 8)->reshape(2, 4)->data, [[1, 2, 0, 0], [5, 6, 7, 0]], [1]],
            'tril:2x4 offset=2'  => ['tril', np::linspace(1, 8, 8)->reshape(2, 4)->data, [[1, 2, 3, 0], [5, 6, 7, 8]], [2]],
            'tril:4x2 offset=-1' => ['tril', np::linspace(1, 8, 8)->reshape(4, 2)->data, [[0, 0], [3, 0], [5, 6], [7, 8]], [-1]],
            'tril:4x2 offset=-2' => ['tril', np::linspace(1, 8, 8)->reshape(4, 2)->data, [[0, 0], [0, 0], [5, 0], [7, 8]], [-2]],
            'tril:2x4 offset=-1' => ['tril', np::linspace(1, 8, 8)->reshape(2, 4)->data, [[0, 0, 0, 0], [5, 0, 0, 0]], [-1]],
            'tril:2x4 offset=-2' => ['tril', np::linspace(1, 8, 8)->reshape(2, 4)->data, [[0, 0, 0, 0], [0, 0, 0, 0]], [-2]],

            // --- triu() ---
            # square
            'triu:3x3 offset=0'  => ['triu', np::linspace(1, 9, 9)->reshape(3, 3)->data, [[1, 2, 3], [0, 5, 6], [0, 0, 9]],],
            'triu:3x3 offset=1'  => ['triu', np::linspace(1, 9, 9)->reshape(3, 3)->data, [[0, 2, 3], [0, 0, 6], [0, 0, 0]], [1]],
            'triu:3x3 offset=2'  => ['triu', np::linspace(1, 9, 9)->reshape(3, 3)->data, [[0, 0, 3], [0, 0, 0], [0, 0, 0]], [2]],
            'triu:3x3 offset=-1' => ['triu', np::linspace(1, 9, 9)->reshape(3, 3)->data, [[1, 2, 3], [4, 5, 6], [0, 8, 9]], [-1]],
            'triu:3x3 offset=-2' => ['triu', np::linspace(1, 9, 9)->reshape(3, 3)->data, [[1, 2, 3], [4, 5, 6], [7, 8, 9]], [-2]],
            # non square
            'triu:4x2 offset=0'  => ['triu', np::linspace(1, 8, 8)->reshape(4, 2)->data, [[1, 2], [0, 4], [0, 0], [0, 0]]],
            'triu:2x4 offset=0'  => ['triu', np::linspace(1, 8, 8)->reshape(2, 4)->data, [[1, 2, 3, 4], [0, 6, 7, 8]]],
            'triu:4x2 offset=1'  => ['triu', np::linspace(1, 8, 8)->reshape(4, 2)->data, [[0, 2], [0, 0], [0, 0], [0, 0]], [1]],
            'triu:4x2 offset=2'  => ['triu', np::linspace(1, 8, 8)->reshape(4, 2)->data, [[0, 0], [0, 0], [0, 0], [0, 0]], [2]],
            'triu:2x4 offset=1'  => ['triu', np::linspace(1, 8, 8)->reshape(2, 4)->data, [[0, 2, 3, 4], [0, 0, 7, 8]], [1]],
            'triu:2x4 offset=2'  => ['triu', np::linspace(1, 8, 8)->reshape(2, 4)->data, [[0, 0, 3, 4], [0, 0, 0, 8]], [2]],
            'triu:2x4 offset=3'  => ['triu', np::linspace(1, 8, 8)->reshape(2, 4)->data, [[0, 0, 0, 4], [0, 0, 0, 0]], [3]],
            'triu:4x2 offset=-1' => ['triu', np::linspace(1, 8, 8)->reshape(4, 2)->data, [[1, 2], [3, 4], [0, 6], [0, 0]], [-1]],
            'triu:4x2 offset=-2' => ['triu', np::linspace(1, 8, 8)->reshape(4, 2)->data, [[1, 2], [3, 4], [5, 6], [0, 8]], [-2]],
            'triu:4x2 offset=-3' => ['triu', np::linspace(1, 8, 8)->reshape(4, 2)->data, [[1, 2], [3, 4], [5, 6], [7, 8]], [-3]],
            'triu:2x4 offset=-1' => ['triu', np::linspace(1, 8, 8)->reshape(2, 4)->data, [[1, 2, 3, 4], [5, 6, 7, 8]], [-1]],
            'triu:empty matrix offset=0' => ['triu', np::ar([[]])->data, [[]]],
            'triu:empty matrix offset=-1' => ['triu', np::ar([[]])->data, [[]], [-1]],

            // --- vander() ---
            'vander:3'  => ['vander', [1, 2, 3], [[1, 1, 1], [4, 2, 1], [9, 3, 1]]],
            'vander:3, 3 cols'  => ['vander', [1, 2, 3], [[1, 1, 1], [4, 2, 1], [9, 3, 1]], [3]],
            'vander:3, 1 cols'  => ['vander', [1, 2, 3], [[1], [1], [1]], [1]],
            'vander:3, 2 cols'  => ['vander', [1, 2, 3], [[1, 1], [2, 1], [3, 1]], [2]],
            'vander:3, 4 cols'  => ['vander', [1, 2, 3], [[1,    1, 1, 1], [8,    4, 2, 1], [27, 9, 3, 1] ], [4]],

            'vander:3, n cols is not an int'  => ['vander', [1, 2, 3], \InvalidArgumentException::class, [[42]]],
            'vander:3, n cols is negative'  => ['vander', [1, 2, 3], \InvalidArgumentException::class, [-1]],
            'vander:3, n cols is float'  => ['vander', [1, 2, 3], \InvalidArgumentException::class, [1.5]],
            'vander:0, empty array'  => ['vander', [], \InvalidArgumentException::class],
            'vander:1x1, ndim>1'  => ['vander', [[0]], \InvalidArgumentException::class],

            // --- exp2() ---
            'exp2:1-dim'  => ['exp2', [0, 1], [1, 2]] ,
            'exp2:2-dim'  => ['exp2', [[0, 1], [1, 0]], [[1, 2], [2, 1]] ],

            // --- expm1() ---
            'expm1:1-dim'  => ['expm1', [0, 1], [0, 1.718281828459]],
            'expm1:2-dim'  => ['expm1', [[0, 1], [1, 0]], [[0, 1.718281828459],   [1.718281828459, 0]] ],   

            // --- exp() ---
            'exp:1-dim'  => ['exp', [0, 1], [1, 2.71828182846]],
            'exp:2-dim'  => ['exp', [[0, 1], [1, 0]], [[1, 2.71828182846], [2.71828182846, 1]] ], 

            // --- sqrt() ---
            'sqrt:1-dim'  => ['sqrt', [0, 1], [0, 1]                                    ],
            'sqrt:2-dim'  => ['sqrt', [[4, 1], [1, 9]], [[2, 1], [1, 3]]                ],
            'sqrt:2-dim negative number'  => ['sqrt', [[-1, 2], [3, 4]],  \InvalidArgumentException::class,],

            // --- square() ---
            'square:1-dim'  => ['square', [0, 1], [0, 1]                                  ],
            'square:2-dim'  => ['square', [[2, 1], [1, 3]], [[4, 1], [1, 9]]              ],

            // --- reciprocal() ---
            'reciprocal:1-dim'  => ['reciprocal', [1, 2, 4], [1, 1/2, 1/4]                ],
            'reciprocal:2-dim'  => ['reciprocal', [[1, 2, 4]], [[1, 1/2, 1/4]]            ],
            'reciprocal:2-dim div by 0'  => ['reciprocal', [[1, 2, 3, 0]],  \InvalidArgumentException::class],

            // --- multiply() ---
            'multiply:1-dim by lambda'  => ['multiply', [0, 2, 4], [0, 10, 20], [5]           ],
            'multiply:1-dim by 1-dim'   => ['multiply', [0, 2, 4], [0, 8, 8], [[0, 4, 2]]     ],

            // --- is_square() ---
            'is_square:1-dim'  => ['is_square', [0, 1], false       ], # 1 dim is not square
            'is_square:2-dim not suaqre'  => ['is_square', [[0, 1]], false                                    ], # 2 dim but not square
            'is_square:4x4x4 not square'  => ['is_square', np::arange(0, 16)->resize(4,4,4)->data, false      ], # 4x4x4 is NOT square
            'is_square:2x2'  => ['is_square', [[0, 1], [1, 0]], true                             ], # 2x2 is square
            'is_square:3x3'  => ['is_square', np::arange(0, 9)->reshape(3,3)->data, true         ], # 3x3 is square
            'is_square:4x4'  => ['is_square', np::arange(0, 16)->reshape(4,4)->data, true        ], # 4x4 is square
        ];
    }

    /**
     * @dataProvider getScenarios
     */
    public function testScenario($func, $input, $expected, $args = null)
    {
        $this->equals(NdArray::class, $func, $input, $expected, $args);
    }
}
