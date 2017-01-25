<?php

namespace SciPhp\NdArray;

use RecursiveIteratorIterator;

/**
 * Visitor methods
 */
trait VisitorTrait
{
  /**
   * Walk on first dimension
   * 
   * @param callable $func
   * 
   * @return \SciPhp\NdArray
   */
  final public function walk(callable $func, array &$data = null)
  {
    null === $data
      ? array_walk($this->data, $func)
      : array_walk($data, $func);      

    return $this;
  }

  /**
   * Walk on last dimension
   * 
   * @param callable $func
   * 
   * @return \SciPhp\NdArray
   */
  final public function walk_recursive(callable $func)
  {
    array_walk_recursive($this->data, $func);

    return $this;
  }

  /**
   * Iterate on next value
   * 
   * @param \RecursiveIteratorIterator &$iterator
   * 
   * @return int|float
   */
  final public function iterate(RecursiveIteratorIterator &$iterator)
  {
    while ($iterator->valid())
    {     
      if (!is_array($iterator->current()))
      {
        $value = $iterator->current();

        $key = $iterator->key();

        $iterator->next();
        // At first iteration on 1 dim array, 
        // key is not incremented
        if ($key == $iterator->key())
        {
          $iterator->next();
        }

        return $value;
      }
      else
      {
        $iterator->next();
      }
    }

    $iterator->rewind();

    return $this->iterate($iterator);
  }
}
