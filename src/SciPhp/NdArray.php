<?php

namespace SciPhp;

use SciPhp\NdArray\Formatter;
use SciPhp\NdArray\Decorator;

/**
 * Base array
 */
final class NdArray extends Decorator
{
    /**
     * Constructor
     * 
     * @param array $data
     */
    final public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Pretty printer
     * 
     * @return string
     */
    final public function __toString()
    {
        return (new Formatter($this))->toString();
    }
}
