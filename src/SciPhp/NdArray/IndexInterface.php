<?php

namespace SciPhp\NdArray;

/**
 * Indexing constants
 */
interface IndexInterface
{
    /**
     * Index must contain only these characters
     */
    const IDX_PAT_FILTER = '/^[,-:\d\s]+$/i';

    /**
     * Index pattern for parsing
     */
    const IDX_PAT_PARSE  = '/\s*
          (?P<start>-?\d+)?\s*
          (?P<col>:)      ?\s*
          (?P<stop>-?\d+) ?\s*
          (?P<comma>,)    ?\s*/ix
  ';
}
