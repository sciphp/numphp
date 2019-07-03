<?php

namespace SciPhpTest\Unit\NumPhp\Traits\NumArray;

use SciPhpTest\Unit\MultiRunner;

class TransposeToTest extends MultiRunner
{
    public function getScenarios()
    {
        // method / input / expected / args
        return [
            // 2 dim (3,1) / shape (3,3)/ 
            ['broadcast_to', [[1], [2], [3]] , [[1,1,1],[2,2,2],[3,3,3]], [[3,3]]],
        ];
    }

    /**
     * @dataProvider getScenarios
     */
    public function testScenario($func, $input, $expected, $args = null)
    {
        $this->staticEquals('\SciPhp\NumPhp', $func, $input, $expected, $args);
    }
}
