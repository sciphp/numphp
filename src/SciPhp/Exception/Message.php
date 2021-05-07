<?php

declare(strict_types=1);

namespace SciPhp\Exception;

abstract class Message
{
    public const UNDEFINED_INDEX = 'Index "%s" is not defined.';

    public const ATTR_NOT_DEFINED = 'Attribute "%s" is not defined. Type="%s".';
    public const ARG_NOT_ARRAY_TUPLE = 'Argument must be an array or a tuple-like.';
    public const ARRAYS_BROADCAST_IMPOSSIBLE = 'Arrays could not be broadcast together [original.shape -> requested->shape]: %s -> %s.';
    public const ARRAYS_BROADCAST_NDIM2_ONLY = "This library can't broadcast to a shape with more than 2 dimensions.";
    public const MAT_NOT_ALIGNED = "Matrices are not aligned.";
    public const ONLY_POSITIVE_INT = 'Must be a positive integer. Given %s.';
    public const ONLY_POSITIVE_NUMBER = 'Must be a positive number. Given %s.';
    public const MAT_NOT_SQUARE = "Given matrix %s is not a square matrix.";
}
