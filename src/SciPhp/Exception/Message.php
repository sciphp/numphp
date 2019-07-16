<?php

namespace SciPhp\Exception;

abstract class Message
{
    /**
     * @var string
     */
    const UNDEFINED_INDEX = 'Index "%s" is not defined.';

    /**
     * @var string
     */
    const ATTR_NOT_DEFINED = 'Attribute "%s" is not defined. Type="%s".';

    /**
     * @var string
     */
    const ARG_NOT_ARRAY_TUPLE = 'Argument must be an array or a tuple-like.';

    /**
     * @var string
     */
    const ARRAYS_BROADCAST_IMPOSSIBLE = 'Arrays could not be broadcast '
                . 'together [original.shape -> requested->shape]: '
                . '%s -> %s.';

    /**
     * @var string
     */
    const ARRAYS_BROADCAST_NDIM2_ONLY = "This library can't broadcast "
                . "to a shape with more than 2 dimensions.";

    /**
     * @var string
     */
    const MAT_NOT_ALIGNED = "Matrices are not aligned.";

    /**
     * @var string
     */
    const ONLY_POSITIVE_INT = 'Must be a positive integer. Given %s.';

    /**
     * @var string
     */
    const ONLY_POSITIVE_NUMBER = 'Must be a positive number. Given %s.';

    /**
     * @var string
     */
    const MAT_NOT_SQUARE = "Given matrix %s is not a square matrix.";
}
