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
   * @param array $args
   */
  public function equals($type, $method, $input, $expected, array $args = null)
  {
    $params = [];

    if (!is_null($args)) {
        while (count($args)) {
          $params[] = array_shift($args);
        }
    }

    $this->processMethod($type, $method, $input, $params, $expected);
  }

  /**
   * Switch between expected returns
   * 
   * @param string $type
   * @param string $method
   * @param mixed $input
   * @param array $params
   * @param mixed $expected
   */
  public function processMethod($type, $method, $input, $params, $expected)
  {
    $ref = new ReflectionMethod($type, $method);

    if (InvalidArgumentException::class === $expected)
    {
      $this->expectException(InvalidArgumentException::class);

      $m = $ref->invokeArgs(new $type($input), $params);
    }
    else
    {
      $m = $ref->invokeArgs(new $type($input), $params);

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

    if (InvalidArgumentException::class === $expected)
    {
      $this->expectException(InvalidArgumentException::class);

      $m = $ref->invokeArgs(null, $params);
    }
    else
    {
      $m = $ref->invokeArgs(null, $params);

      $this->assertEquals(
        $expected,
        $m instanceof \SciPhp\NdArray ? $m->data : $m,
        '',
        0.00000001
      );
    }
  }
}
