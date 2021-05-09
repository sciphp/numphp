<?php

declare(strict_types=1);

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
     * @param mixed $value
     */
    final public function __set(string $name, $value): ?self
    {
        switch ($name) {
            case 'shape':
                return $this->__construct(
                    $this->reshape($value)->data
                );
            default:
                throw new InvalidAttributeException(static::class, $name);
        }
    }

    /**
     * Generic getter
     *
     * @return int|array|NdArray
     * @throws \SciPhp\Exception\InvalidAttributeException
     */
    final public function __get(string $name)
    {
        switch ($name) {
            case 'data':
                return $this->data;
            case 'ndim':
                return count($this->shape);
            case 'size':
                return $this->getSize();
            case 'shape':
                return $this->getShape($this->data, []);
            case 'T':
                return np::transpose($this);
        }

        throw new InvalidAttributeException(static::class, $name);
    }

    /**
     * Get the total number of elements of the array
     */
    final protected function getSize(): int
    {
        if (count($this->data)) {
            return array_product($this->shape);
        }

        return 0;
    }

    /**
     * @param array|int|float $data
     */
    abstract protected function getShape($data, array $shape): array;
}
