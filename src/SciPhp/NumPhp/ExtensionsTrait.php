<?php

namespace SciPhp\NumPhp;

use SciPhp\LinAlg;

trait ExtensionsTrait
{
    /**
     * @var \SciPhp\LinAlg LinAlg instance
     */
    private static $linalg;

    /**
     * Loads Linear Algebra extension
     *
     * @return \SciPhp\LinAlg Linear algebra wrapper instance
     * @link http://sciphp.org/ref.linalg Documentation
     *
     * @since 0.3.0
     * @api
     */
     final public static function linalg(): LinAlg
     {
        if (is_null(self::$linalg)) {
            self::$linalg = new LinAlg();
        }

        return self::$linalg;
    }
}
