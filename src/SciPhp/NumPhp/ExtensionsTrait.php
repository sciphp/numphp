<?php

namespace SciPhp\NumPhp;

use SciPhp\LinAlg;
use SciPhp\Random;

trait ExtensionsTrait
{
    /**
     * @var \SciPhp\LinAlg LinAlg instance
     */
    private static $linalg;

    /**
     * @var \SciPhp\Random Random instance
     */
    private static $random;

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
        if (\is_null(self::$linalg)) {
            self::$linalg = new LinAlg();
        }

        return self::$linalg;
    }

    /**
     * Loads Random generator extension
     *
     * @return \SciPhp\Random Random wrapper instance
     * @link http://sciphp.org/ref.random Documentation
     *
     * @since 0.5.0
     * @api
     */
     final public static function random(): Random
     {
        if (\is_null(self::$random)) {
            self::$random = new Random();
        }

        return self::$random;
    }
}
