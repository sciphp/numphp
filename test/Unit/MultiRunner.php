<?php

namespace SciPhpTest\Unit;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use ReflectionMethod;

class MultiRunner extends TestCase
{
    /**
     * Test equality for a method
     * 
     * @param string $type
     * @param string $method
     * @param mixed $input
     * @param mixed $expected
     * @param array|object $args
     */
    public function equals($type, $method, $input, $expected, $args = null)
    {
        $params = [];

        if (is_object($args)) {
            $params = [$args];
        } elseif (is_array($args)) {
            while (count($args)) {
                $params[] = array_shift($args);
            }
        }

        $this->processMethod($type, $method, $input, $params, $expected);
    }

    /**
     * Switch between expected returns
     * 
     * @param string|object $type
     * @param string $method
     * @param mixed $input
     * @param array $params
     * @param mixed $expected
     */
    public function processMethod($type, $method, $input, $params, $expected)
    {
        if (InvalidArgumentException::class === $expected) {
            $this->expectException(InvalidArgumentException::class);
            $m = new $type($input);
            $m->$method(...$params);

        // Instanciate with $input and pass $params to the tested method
        } elseif (is_string($type)) {
            $m = new $type($input);
            $m = $m->$method(...$params);
            $this->assertEquals(
                $expected,
                $m instanceof \SciPhp\NdArray ? $m->data : $m
            );
        // Class has been instanciated, just pass $params to the tested method
        } else {
            $m = $type->$method(...$params);

            $this->assertEquals(
                $expected,
                $m instanceof \SciPhp\NdArray ? $m->data : $m
            );
        }
    }

    /**
     * Test equality for a static method
     * 
     * @param string $type
     * @param string $method
     * @param mixed $input
     * @param mixed $expected
     * @param array $args
     */
    public function staticEquals($type, $method, $input, $expected, array $args = null)
    {
        $params[] = $input;

        if (!is_null($args)) {
                while (count($args)) {
                    $params[] = array_shift($args);
                }
        }

        $this->processStaticMethod($type, $method, $params, $expected);
    }

    /**
     * Static switch between expected returns
     * 
     * @param string $type
     * @param string $method
     * @param array $params
     * @param mixed $expected
     */
    public function processStaticMethod($type, $method, $params, $expected)
    {
        $ref = new ReflectionMethod($type, $method);

        if (InvalidArgumentException::class === $expected) {
            $this->expectException(InvalidArgumentException::class);

            $m = $ref->invokeArgs(null, $params);
        } else {
            $m = $ref->invokeArgs(null, $params);

            // Support for PHP 7.1+
            if (version_compare(PHP_VERSION, '7.1.0') >= 0) {
                $this->assertEqualsWithDelta(
                    $expected,
                    $m instanceof \SciPhp\NdArray ? $m->data : $m,
                    0.00000001
                );
            // Support for PHP 5.6, 7.0
            } else {
                $this->assertEquals(
                    $expected,
                    $m instanceof \SciPhp\NdArray ? $m->data : $m,
                    '',
                    0.00000001
                );
            }
        }
    }
}
