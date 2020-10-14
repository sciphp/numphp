<?php

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

        if (($handle = fopen($file, "r")) !== false) {
            $row = 0;

            while (false !== ($data = fgetcsv($handle, 2048, $options['delimiter']))) {
                if ($row == 0) {
                    $num = count($data);
                }

                Assert::eq($num, count($data));

                if ($options['headers'] && $row == 0) {
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
