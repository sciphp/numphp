<?php

declare(strict_types=1);

namespace SciPhp\NumPhp;

/**
 * Multiple inheritance for NumPhp
 *
 * @static \SciPhp\NdArray ar() Create a NdArray from a PHP array
 */
abstract class Decorator
{
    use ArithmeticTrait;
    use DiagonalTrait;
    use ExponentTrait;
    use ExtensionsTrait;
    use FileTrait;
    use FloatTrait;
    use LogarithmTrait;
    use Mathematical\TrigonometricTrait;
    use MatrixTrait;
    use NumArrayTrait;
    use OperationTrait;
    use RangeTrait;
    use TriangleTrait;
    use VanderTrait;
}
