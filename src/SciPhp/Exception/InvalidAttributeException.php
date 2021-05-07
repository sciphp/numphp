<?php

declare(strict_types=1);

namespace SciPhp\Exception;

use Exception;

final class InvalidAttributeException extends Exception
{
    public function __construct(string $class, string $attribute)
    {
        $message = sprintf(
            Message::ATTR_NOT_DEFINED,
            $attribute,
            $class
        );

        parent::__construct($message, 0, null);
    }
}
