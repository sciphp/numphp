<?php

namespace SciPhp\NumPhp;

use SciPhp\LinAlg;

trait ExtensionsTrait
{
    private static $linalg;

    /**
     * Linear algebra extension
     * 
     * @return \SciPhp\LinAlg A Linear algebra
     * @link http://sciphp.org/numphp.linalg Documentation
     * @api
     */
     final public static function linalg()
     {
        if (is_null(self::$linalg)) {
            self::$linalg = new LinAlg();
        }

        return self::$linalg;
    }
}
