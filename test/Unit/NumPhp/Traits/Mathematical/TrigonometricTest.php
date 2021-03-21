<?php

namespace SciPhpTest\Unit\NumPhp\Traits\Mathematical;

use SciPhp\NumPhp;
use SciPhpTest\Unit\NdArray\Traits\Mathematical\TrigonometricTest as BridgeTest;

class TrigonometricTest extends BridgeTest
{
    public function getScenarios()
    {
        // method / input / expected / args
        return [
            // --- cos() ---
            ['cos', M_PI, -1, ],
            ['cos', M_PI_2, 0, ],
            ['cos', 0, 1, ],

            // --- sin() ---
            ['sin', M_PI, 0, ],
            ['sin', M_PI_2, 1, ],
            ['sin', 0, 0, ],

            // --- tan() ---
            ['tan', 0, 0, ],
            ['tan', 1, 1.5574077246549, ],
            ['tan', M_PI / 4, 1, ],

            # \InvalidArgumentException
            ['cos', 'hello',       \InvalidArgumentException::class],
            ['sin', 'hello',       \InvalidArgumentException::class],
            ['tan', 'hello',       \InvalidArgumentException::class],
        ] + parent::getScenarios();
    }

   /**
    * @dataProvider getScenarios
    */
    public function testScenario($func, $input, $expected, $args = null)
    {
        $this->staticEquals(NumPhp::class, $func, $input, $expected, $args);
    }
}
