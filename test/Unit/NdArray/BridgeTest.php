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
