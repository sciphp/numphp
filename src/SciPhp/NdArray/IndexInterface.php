<?php

declare(strict_types=1);

namespace SciPhp\NdArray;

/**
 * Indexing constants
 */
interface IndexInterface
{
    /**
     * Index must contain only these characters
     */
    public const IDX_PAT_FILTER = '/^[,-:\d\s]+$/i';

    /**
     * Index pattern for parsing
     */
    public const IDX_PAT_PARSE = '/\s*
          (?P<start>-?\d+)?\s*
          (?P<col>:)      ?\s*
          (?P<stop>-?\d+) ?\s*
          (?P<comma>,)    ?\s*/ix
  ';
}
