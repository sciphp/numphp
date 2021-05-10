<?php

declare(strict_types=1);

namespace SciPhp\NumPhp;

use SciPhp\NdArray;
use Webmozart\Assert\Assert;

/**
 * File methods
 */
trait FileTrait
{
    /**
     * Load data from a text file.
     *
     * @param string $file
     *
     * @param array $options
     *  default is
     *  [
     *    'headers'   => false,
     *    'delimiter' => ';'
     *  ]
     *
     * @link http://sciphp.org/numphp.loadtxt Documentation
     *
     * @api
     */
    final public static function loadtxt(string $file, array $options = []): NdArray
    {
        Assert::string($file);
        Assert::file($file = realpath($file));

        $m = [];
        $options = array_merge(
            ['headers' => false, 'delimiter' => ';'],
            $options
        );

        $handle = fopen($file, 'r');
        if ($handle !== false) {
            $row = 0;
            $num = 0;

            while (($data = fgetcsv($handle, 2048, $options['delimiter'])) !== false) {
                if ($row === 0) {
                    $num = count($data);
                }

                Assert::eq($num, count($data));

                if ($options['headers'] && $row === 0) {
                    // skip headers
                    $options['headers'] = false;
                } else {
                    $m[] = $data;
                }

                $row++;
            }

            fclose($handle);
        }

        return static::ar($m);
    }
}
