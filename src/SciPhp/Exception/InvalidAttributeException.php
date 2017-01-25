<?php

namespace SciPhp\Exception;

use Exception;

class InvalidAttributeException extends Exception
{
  public function __construct($class, $attribute, $name = null)
  {
    $message = sprintf('Attribute "%s" is not defined. Type="%s"'
      , $attribute
      , $class
    );

    parent::__construct($message, 0, null);
  }
}
