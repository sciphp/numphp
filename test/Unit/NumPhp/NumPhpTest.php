<?php

namespace SciPhpTest\NumPhp;

use PHPUnit\Framework\TestCase;
use SciPhp\NumPhp as np;

class NumPhpTest extends TestCase
{
    /**
     * A basic call must return a NdArray
     */
    public function testReturnNdArray()
    {
        $v = np::ar([]);

        $this->assertInstanceOf('SciPhp\\NdArray', $v);
    }

    /**
     * parseArgs() with a 1-dim array, tuple mode
     */
    public function testParseArgsOneDim()
    {
        $this->assertEquals(
            [1, 2, 3],
            np::parseArgs([1, 2, 3])
        );
        
        // Empty tuple
        $this->assertEquals(
            [],
            np::parseArgs([]),
            'Empty tuple failed'
        );
    }

    /**
     * parseArgs() with a 2-dim array, array mode
     */
    public function testParseArgsTwoDim()
    {
        $this->assertEquals(
            [1, 2, 3],
            np::parseArgs([[1, 2, 3]])
        );
        
        // Empty array
        $this->assertEquals(
            [],
            np::parseArgs([[]]),
            'Empty array failed'
        );
    }

    /**
     * parseArgs() with a 3-dim array
     */
    public function testParseArgsThreeDim()
    {
        $this->expectException(\InvalidArgumentException::class);

        np::parseArgs([[[1, 2, 3]]]);
    }
}
