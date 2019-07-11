<?php

namespace SciPhp\LinAlg;

/**
 * Multiple inheritance for LinAlg
 */
abstract class Decorator
{
    use CholeskyTrait;
    use NormsTrait;
}
