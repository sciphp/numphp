<?php

namespace SciPhpTest\Unit\NumPhp\LinAlg;

use SciPhp\NumPhp as np;
use SciPhpTest\Unit\MultiRunner;

class CholeskyTest extends MultiRunner
{
    public function getScenarios()
    {
        // method / input / expected / args
        return [
// 3x3 positive-definite
['cholesky', 
    [[ 2,  -1,  0 ],
     [-1,   2, -1 ],
     [ 0,  -1,  2 ]],

    [[1.4142135623731,    0,                  0,               ],
     [-0.70710678118655,  1.2247448713916,    0,               ],
     [0                 , -0.81649658092773,  1.1547005383793  ]]
                                                                       ],

# 4x4 positive matrix
['cholesky', 
    [[1 , 1 , 1  , 1 ],
     [1 , 5 , 5  , 5 ],
     [1 , 5 , 14 , 14 ],
     [1 , 5 , 14 , 15 ]],    
     
    [[1, 0, 0, 0],
     [1, 2, 0, 0],
     [1, 2, 3, 0],
     [1, 2, 3, 1]]                                                     ],

# # Not a square matrix
['cholesky', 
    [[1 , 1 , 1  , 1 ],
     [1 , 5 , 5  , 5 ],
     [1 , 5 , 14 , 14 ]],    
     
    \InvalidArgumentException::class                                   ],

# Not positive-definite matrix
['cholesky', 
    [[1,  7,  3 ],
     [7,  4, -5 ],
     [3, -5,  6 ]],

    \InvalidArgumentException::class                                   ],

# Not a symmetric matrix
['cholesky', 
    [[1,2,3],
     [2,4,5],
     [1,2,3]],

    \InvalidArgumentException::class                                   ],
 
        ];
    }

    /**
     * @dataProvider getScenarios
     */
    public function testScenario($func, $input, $expected, $args = null)
    {
        $matrix = np::ar($input);

        // Input won be used here
        $this->equals(np::linalg(), $func, null, $expected, $matrix);
    }
}
