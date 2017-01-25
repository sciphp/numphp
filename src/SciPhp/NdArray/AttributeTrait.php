<?php

namespace SciPhp\NdArray;

use SciPhp\Exception\InvalidAttributeException;
use SciPhp\NumPhp as np;

/**
 * Attribute methods for NdArray
 */
trait AttributeTrait
{
  /**
   * @var array 
   */
  protected $data = [];

  /**
   * Attribute setter
   * 
   * @param string $name
   * 
   * @param mixed $value
   */
  final public function __set($name, $value)
  {
    switch ($name)
    {
      case 'shape':
        return $this->__construct(
          $this->reshape($value)->data
        );
      default:
        throw new InvalidAttributeException(__CLASS__, $name);
    }
  }

  /**
   * Generic getter
   * 
   * @param string $name
   * 
   * @return mixed
   * 
   * @throws \SciPhp\Exception\InvalidAttributeException
   */
  final public function __get($name)
  {
    switch ($name)
    {
      case 'data':
        return $this->data;
      case 'ndim':
        return (int)$this->getNdim($this->data);
      case 'size':
        return $this->getSize();
      case 'shape':
        return $this->getShape($this->data, []);
      case 'T':
        return np::transpose($this);
    }

    throw new InvalidAttributeException(__CLASS__, $name);
  }

  /**
   * Gets NdArray rank
   * 
   * @param array $data
   * 
   * @return int
   */
  final protected function getNdim(array $data)
  {
    if (isset($data[0]))
    {
      return is_array($data[0])
        ? 1 + $this->getNdim($data[0])
        : 1;
    }
  }

  /**
   * Gets the total number of elements of the array
   * 
   * @param int $count current count
   * 
   * @return int
   */
  final protected function getSize($count = 0)
  {
    array_walk_recursive(
      $this->data,
      function ($item) use (&$count) {
        $count++;
      }
    );

    return $count;
  }

  protected abstract function getShape($data, $shape);
}
