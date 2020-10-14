<?php

namespace SciPhpTest\Unit\NumPhp\Traits\File;

use SciPhpTest\Unit\MultiRunner;

class LoadtxtTest extends MultiRunner
{
  public function getScenarios()
  {
    // method / input / expected / args
    return [
      ['loadtxt', getcwd() . '/test/Resources/files/simple-headers.csv' , [[7,0.27,0.36],[6.3,0.3,0.34],[8.1,0.28,0.4]], [ ['headers' => true] ]     ],
      ['loadtxt', getcwd() . '/test/Resources/files/simple-noheaders.csv' , [[7,0.27,0.36],[6.3,0.3,0.34],[8.1,0.28,0.4]]                            ],
      ['loadtxt', getcwd() . '/test/Resources/files/simple-noheaders.csv' , [[7,0.27,0.36],[6.3,0.3,0.34],[8.1,0.28,0.4]], [ ['headers' => false] ]  ],
      ['loadtxt', getcwd() . '/test/Resources/files/simple-spacedelimiter.csv' , [[7,0.27,0.36],[6.3,0.3,0.34],[8.1,0.28,0.4]], [ ['headers' => true, 'delimiter' => " "] ]  ],

      # \InvalidArgumentException
      ['loadtxt', 1,             \InvalidArgumentException::class],
      ['loadtxt', 'fileDoesNotExist.csv',  \InvalidArgumentException::class],
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
