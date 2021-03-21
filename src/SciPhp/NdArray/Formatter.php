<?php

namespace SciPhp\NdArray;

use SciPhp\NdArray;
use SciPhp\NumPhp as np;

/**
 * NdArray formatter
 */
final class Formatter
{
    /**
     * @var int
     */
    private $maxColSize = 0;

    /**
     * @var int
     */
    private $maxRows = 10;

    /**
     * @var \SciPhp\NdArray
     */
    private $array;

    /**
     * @var int
     */
    private $indent = 0;

    /**
     * @var string
     */
    private $string = '';

    /**
     * @var bool
     *
     * Is there any negative number ?
     */
    private $negative = false;

    /**
     * Set array data and options
     */
    public function __construct(NdArray $array)
    {
        // truncate
        if (count($array->data) > $this->maxRows) {
            $data = $array->data;
            array_splice(
                $data,
                ceil($this->maxRows/2),
                count($data) - $this->maxRows,
                [ array_pad([], count($data[0]), '...') ]
            );
            $array = np::ar($data);
        }

        $this->array = $array;

        // Estimate max column size
        $this->array->walk_recursive(
            function($item) {
                
                $negative = $item < 0;
                $length = strlen($item);

                if ($negative) {
                    $length++;
                    if (!$this->negative) {
                        $this->negative = true;
                    }
                }

                if ($length > $this->maxColSize) {
                    $this->maxColSize = $length;
                }
        });
    }

    /**
     * Stringify an array
     */
    public function toString(): string
    {
        $this->traverse($this->array->data);

        return "[{$this->string}]\n";
    }

    /**
     * Traverse an array and render as string
     */
    private function traverse(array $array): void
    {
        $count = count($array);

        $this->indent++;

        array_walk(
            $array,
            function($item, $key) use ($count) {
                if (\is_array($item)) {
                    if ($key > 0) {
                        $this->string .= PHP_EOL . $this->indent();
                    }

                    $this->string .= '[';
                    $this->traverse($item);
                    $this->string .= ']';
                } else {
                    $this->string .= $this->formatNumber(
                        $item,
                        $key === $count - 1
                    );
                }
            }
        );

        $this->indent--;
    }

    /**
     * Format a number with column sizing
     *
     * @param mixed $number
     * @param bool  $last
     */
    private function formatNumber($number, bool $last): string
    {
        switch (true) {
            case null === $number:
                $number = 'null';
                break;
            case true === $number:
                $number = 'true';
                break;
            case false === $number:
                $number = 'false';
                break;
            default: # Workaround for code coverage
        }

        $representation = $number;

        // Format opsitive numbers
        if (is_numeric($number)) {
            // Number is not negative, but there are some
            if ($number > 0 && $this->negative) {
                $representation = ' ' . $representation;
            }
        }

        return $last
            ? sprintf("%-{$this->maxColSize}s"  , $representation)
            : sprintf("%-{$this->maxColSize}s  ", $representation);
    }

    /**
     * Render an indent
     */
    private function indent(): string
    {
        return str_repeat(' ', $this->indent);
    }
}
