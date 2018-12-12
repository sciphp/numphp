<?php

namespace SciPhp\NdArray;

use ArrayAccess;
use Countable;

/**
 * Multiple inheritance for NdArray
 */
abstract class Decorator implements ArrayAccess, Countable, IndexInterface
{
  use ArithmeticTrait;
  use AttributeTrait;
  use BasicTrait;
  use DiagonalTrait;
  use ExponentTrait;
  use FloatTrait;
  use IndexTrait;
  use LogarithmTrait;
  use OperationTrait;
  use ShapeTrait;
  use TriangleTrait;
  use VanderTrait;
  use VisitorTrait;
}
