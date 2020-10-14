<?php

namespace SciPhp\NdArray;

use SciPhp\Exception\Message;
use SciPhp\NdArray;
use Webmozart\Assert\Assert;

/**
 * Indexing methods for NdArray
 */
trait IndexTrait
{
    /**
     * Get a view by index
     *
     * @param mixed $index
     * @return mixed
     */
    final public function offsetGet($index)
    {
        // @todo slicing or indexing switch here
        if ((is_string($index) || is_int($index))
             && preg_match(static::IDX_PAT_FILTER, $index)
             && preg_match_all(static::IDX_PAT_PARSE, $index, $matches)
        ) {
            $params = $this->indexFilter($matches);

            $data = $this->filterGet($params, 0, $this->data);

            return is_array($data) ? new static($data) : $data;
        }
        // @todo filtering with array and NdArray

        return Assert::false($index, Message::UNDEFINED_INDEX);
    }

    /**
     * Set a view by index
     *
     * @param int|string $index
     *
     * @param int|string $value
     *
     * @return \SciPhp\NdArray
     */
    final public function offsetSet($index, $value): NdArray
    {
        if ((is_string($index) || is_int($index))
                 && preg_match(static::IDX_PAT_FILTER, $index)
                 && preg_match_all(static::IDX_PAT_PARSE, $index, $matches)
        ) {
            $params = $this->indexFilter($matches);

            $this->filterSet($params, 0, $this->data, $value);
        } else {
            return Assert::false($index, Message::UNDEFINED_INDEX);
        }

        return $this;
    }

    /**
     * Get values from an element or a range
     *
     * @param array $filter
     * @param int $index
     * @param array $data
     * @return int|float|array $value
     */
    final protected function filterGet(array $filter, int $index, array &$data = null)
    {
        if (!isset($filter['start'][$index])) {
            return $data;
        }

        list($start, $stop) = $this->filterRange($filter, $index, count($data));

        $stack = array_map(
            function($value) use ($filter, $index) {
                return is_array($value)
                         ? $this->filterGet($filter, $index + 1, $value)
                         : $value;
            },
            array_slice($data, $start, $stop - $start + 1)
        );

        return $start === $stop ? $stack[0] : $stack;
    }

    /**
     * Assign values to an element or a range
     *
     * @param array $filter
     * @param int $index
     * @param array $data
     * @param int|float $value
     */
    final protected function filterSet(array $filter, int $index, array &$data = null, $value)
    {
        if (!isset($filter['start'][$index])) {
            return array_walk_recursive($data, function(&$item) use ($value) {
                $item = $value;
            });
        }

        list($start, $stop) = $this->filterRange($filter, $index, count($data));

        array_walk(
            $data,
            function(&$item, $key) use ($filter, $index, $value, $start, $stop) {
                if ($key >= $start && $key <= $stop) {
                    if (is_array($item)) {
                        $this->filterSet($filter, $index+1, $item, $value);
                    }
                    else {
                        $item = $value;
                    }
                }
            }
        );
    }

    /**
     * Prepare filter values
     */
    final protected function indexFilter(array $matches): array
    {
        $filter = [];

        array_walk(
            $matches,
            function($item, $key) use (&$filter) {
                if (!is_int($key)) {
                    $filter[$key] = $item;
                }
            }
        );

        $params = [];

        array_walk(
            $filter['start'],
            function($value, $key) use (&$params, $filter) {
                if ($key == 0) {
                    $index = sprintf(
                            '%s%s%s%s',
                            $value,
                            $filter['col'] [$key],
                            $filter['stop'][$key],
                            $filter['comma'][$key]
                    );
                    Assert::notEq(
                        $index,
                        ',',
                        "Invalid index syntax. Index=$index"
                    );
                }

                if ($value !== ''
                    || $filter['col'] [$key] !== ''
                    || $filter['stop'][$key] !== ''
                    || $filter['comma'][$key] !== ''
                ) {
                    $params['start'][] = intval($value);
                    $params['col']  [] = $filter['col'][$key];

                    if ($filter['col'][$key] === ':') {
                        $stop = $filter['stop'][$key] != ''
                            ? intval($filter['stop'][$key]) : 'max';
                    } else {
                        $stop = intval($value);
                    }

                    $params['stop'] [] = $stop;
                    $params['comma'][] = $filter['comma'][$key];
                }
            }
        );

        return $params;
    }

    /**
     * Get range definition
     *
     * @return int[$start, $stop]
     */
    final protected function filterRange(array $filter, int $index, int $count): array
    {
        // eq. '-1' '-1,' '-1:-1,' '-2:-1,'
        if ($filter['start'][$index] < 0) {
            $filter['start'][$index] = $count + $filter['start'][$index] ;
        }

        // all, eq. ','    ':,' '0:0,'
        if ($filter['start'][$index] === 0
          && $filter['stop'][$index] === 'max'
        ) {
            $filter['start'][$index] = 0;
            $filter['stop'][$index] = $count - 1;
        }

        $start = $filter['start'][$index];

        Assert::range($start, 0, $count - 1);

        if ($filter['stop'][$index] === 'max') {
            $filter['stop'][$index]  = $count - 1;
        }

        // eq. ':-1,' '2:-2,'
        if ($filter['stop'][$index] < 0) {
            $stop = $count + $filter['stop'][$index]; //  - 1;
        }
        // eq. ':5,' '2:3,'
        elseif ($filter['stop'][$index] >= 0) {
            $stop = $filter['stop'][$index];
        }

        Assert::range($stop, $start, $count - 1, 'Stop index must be [%s, %s]. Got %s.');

        return [$start, $stop];
    }

    /**
     * Remove a portion of the data array
     *
     * @param mixed $offset
     */
    final public function offsetUnset($offset): bool
    {
        return is_array(array_splice($this->data, $offset));
    }

    /**
     * Check that an index is defined
     *
     * @param mixed $offset
     */
    final public function offsetExists($offset): bool
    {
        return isset($this->data[$offset])
                || array_key_exists($offset, $this->data);
    }
}
