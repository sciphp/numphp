<?php

include __DIR__ . '/../../../vendor/autoload.php';

use SciPhp\NumPhp as np;

for ($i = 1; $i < 11; $i++)
{
  for ($j = 1; $j < 11; $j++)
  {
    for ($k = -5; $k < 5; $k++)
    {
      $m = np::eye($i, $j, $k);
    }
  }
}
