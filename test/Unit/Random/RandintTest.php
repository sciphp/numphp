<?php

namespace SciPhpTest\Unit\Random;

use SciPhp\NdArray;
use SciPhp\NumPhp as np;
use SciPhpTest\Unit\MultiRunner;

class RandintTest extends MultiRunner
{
    /**
     * Provide exceptions scenarios
     */
    public function getExceptionScenarios(): array
    {
        return [
            // low, high, size
            'single value - low only - low must be positive'  => [ -5, null, null],
            'single value - low must be > max'  => [ 15, 12, null],
            
            '1-dim range - low only must be positive'  => [ -10, null, 5],
            '1-dim range - bad range'  => [ -10, null, -5],
            '1-dim range - bad array shape'  => [ -5, -6, [-5]],
        ];
    }

    /**
     * Test calls that throw an exception
     *
     * @dataProvider getExceptionScenarios
     */
    public function test_exception_scenarios($low, $high, $size): void
    {
        $this->expectException(\InvalidArgumentException::class);

        $ret = np::random()->randint($low, $high, $size);
    }

    /**
     * Provide valid scenarios
     */
    public function getScenarios(): array
    {
        return [
            // low, high, size, expected between[min, max], expected shape
            'single value - low only'  => [ 5, null, null, [0, 4], null],
            'single value - low and max'  => [ 5, 12, null, [5, 11], null],
            'single value - low negative and max'  => [ -5, 6, null, [-5, 5], null],

            '1-dim range - low only'  => [ 10, null, 5, [0, 9], [5]],
            '1-dim range - low and max'  => [ -5, 6, 10, [-5, 5], [10]],

            '2-dim range - low only'  => [ 10, null, [5, 5], [0, 9], [5, 5]],
            '2-dim range - low and max'  => [ -5, 6, [10, 2], [-5, 5], [10, 2]],

            '3-dim range - low only'  => [ 10, null, [5, 5, 4], [0, 9], [5, 5, 4]],
            '3-dim range - low and max'  => [ -5, 6, [10, 2, 2], [-5, 5], [10, 2, 2]],
        ];
    }

    /**
     * @dataProvider getScenarios
     */
    public function test_good_shape_and_values($low, $high, $size, array $expectedBetween, $expectedShape = null): void
    {
        $m = np::random()->randint($low, $high, $size);

        // A random int
        if (is_null($size)) {
            $this->assertIsInt($m);
            $this->assertGreaterThanOrEqual($expectedBetween[0], $m);
            $this->assertLessThanOrEqual($expectedBetween[1], $m);
        // A NdArray
        } else {
            $this->assertInstanceOf(NdArray::class, $m);
            $this->assertEquals($expectedShape, $m->shape);

            foreach ($m->ravel()->data as $value) {
                $this->assertIsInt($value);
                $this->assertGreaterThanOrEqual($expectedBetween[0], $value);
                $this->assertLessThanOrEqual($expectedBetween[1], $value);
            }
        }
    }
}
