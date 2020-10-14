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
     * @param mixed $value
     */
    final public function __set(string $name, $value)
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
     * @param  string $name
     * @return mixed
     * @throws \SciPhp\Exception\InvalidAttributeException
     */
    final public function __get(string $name)
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
     */
    final protected function getNdim(array $data): int
    {
        if (isset($data[0])) {
            return is_array($data[0])
                ? 1 + $this->getNdim($data[0])
                : 1;
        }
        return 0;
    }

    /**
     * Gets the total number of elements of the array
     */
    final protected function getSize(int $count = 0): int
    {
        array_walk_recursive(
            $this->data,
            function () use (&$count) {
                $count++;
            }
        );

        return $count;
    }

    protected abstract function getShape($data, array $shape): array;
}
