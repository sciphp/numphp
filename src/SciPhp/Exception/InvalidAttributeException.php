<?php

namespace SciPhp\Exception;

use Exception;

class InvalidAttributeException extends Exception
{
    public function __construct($class, $attribute)
    {
        $message = sprintf(
            Message::ATTR_NOT_DEFINED,
            $attribute,
            $class
        );

        parent::__construct($message, 0, null);
    }
}
