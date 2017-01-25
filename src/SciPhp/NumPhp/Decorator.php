<?php

namespace SciPhp\NumPhp;

/**
 * Multiple inheritance for NumPhp
 */
abstract class Decorator
{
  use ArithmeticTrait;
  use DiagonalTrait;
  use ExponentTrait;
  use FileTrait;
  use FloatTrait;
  use LogarithmTrait;
  use MatrixTrait;
  use NumArrayTrait;
  use OperationTrait;
  use RangeTrait;
  use TriangleTrait;
  use VanderTrait;
}
