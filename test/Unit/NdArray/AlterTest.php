<?php

namespace SciPhpTest\NdArray;

use PHPUnit\Framework\TestCase;
use SciPhp\NumPhp as np;

/**
 * Any operation must have no impact on storage data
 */
class AlterTest extends TestCase
{
  public function getScenarios()
  {
    // method / param 0 / param ... / param n - 1
    return [
      ['reciprocal'],
      ['divide',   [1, 2, 3, 4]],
      ['multiply', [1, 2, 3, 4]],
      ['subtract', [1, 2, 3, 4]],
      ['dot',      [1, 2, 3, 4]],
      ['add',      [1, 2, 3, 4]],
      ['power',    2],
      ['copy'],
      ['negative'],
      ['log'],
      ['sum'],
      ['ravel'],
      ['resize',   2, 2],
      ['reshape',  2, 2],
      ['tril'],
      ['triu']
    ];
  }

  /**
   * @dataProvider getScenarios
   */
  public function testAlter2Dim($method)
  {
    $input = [[1, 2, 3, 4]];

    $m = np::ar($input);

    $args = func_get_args();

    switch (func_num_args())
    {
      case 1:
        $m->$method();
        break;
      case 2:
        $m->$method($args[1]);
        break;
      case 3:
        $m->$method($args[1], $args[2]);
        break;
      default:
        throw new \Exception(
          sprintf(
            '%s() does not accept %d arguments',
            __METHOD__,
            func_num_args()
          )
        );
        break;    
    }

    $this->assertEquals($input, $m->data);
  }

  /**
   * vander() only accepts vectors
   */
  public function testVanderOneDim()
  {
    $input = [1, 2, 3, 4];

    $m = np::ar($input);

    $m->vander();

    $this->assertEquals($input, $m->data);
  }
}
