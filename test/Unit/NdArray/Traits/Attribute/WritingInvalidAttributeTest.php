<?php

namespace SciPhpTest\NdArray\Traits\Attribute;

use SciPhp\Exception\InvalidAttributeException;
use PHPUnit\Framework\TestCase;
use SciPhp\NdArray;

class WritingInvalidAttributeTest extends TestCase
{
  /**
   * Invalid attributes
   */
  public function getScenarios()
  {
    // attribute, input
    return [
      ['notExisting', [1, 2, 3] ]
    ];
  }

  /**
   * @dataProvider getScenarios
   */
  public function testScenario($attr, $input)
  {
    $this->expectException(InvalidAttributeException::class);

    $m = new NdArray($input);

    $m->$attr = 5;
  }
}
