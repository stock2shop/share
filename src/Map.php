<?php

declare(strict_types=1);

namespace Stock2Shop\Share;

use Traversable;

/**
 * @template TKey
 * @template TValue
 * @implements IteratorInterface<TKey, TValue>
 */
class Map implements IteratorInterface
{
    /**
     * Map of key and values.
     * Once a map has values created, any value added must be of the same type.
     *
     * @var array<TKey, TValue>
     */
    private array $map;

    /**
     * @param array<int, TValue> $data
     * @param string $key
     */
    public function __construct(array $data, private readonly string $key)
    {
        $this->map = [];
        foreach ($data as $item) {
            /** @var TKey $key */
            $key = $this->getKey($item);

            // no duplicates allowed
            if (!empty($this->map[$key])) {
                throw new \InvalidArgumentException('Duplicate key');
            }
            // check type match existing
            $this->validateType($item);

            // add
            $this->map[$key] = $item;
        }
        $this->sort();
    }

    private function validateType(mixed $value): void
    {
        if (!empty($this->map)) {
            $first = array_slice($this->map, 0, 1);
            $v     = array_values($first)[0];
            if (is_array($v)) {
                if (!is_array($value) || !empty(array_diff_key($v, $value))) {
                    throw new \InvalidArgumentException('Invalid type, keys are different');
                }
            } else {
                if (!is_object($value) || (get_class($v) !== get_class($value))) {
                    throw new \InvalidArgumentException('Invalid type, objects are different');
                }
            }
        }
    }

    /**
     * TODO allowing blank keys for time being, remove once fixed hash tests.
     * @param mixed $item
     * @return mixed
     */
    private function getKey(mixed $item): mixed
    {

        if (is_array($item)) {
            if (
                !isset($item[$this->key])) {
                throw new \InvalidArgumentException('Empty key');
            }
            return $item[$this->key];
        } elseif (is_object($item)) {
            if (!isset($item->{$this->key})) {
                throw new \InvalidArgumentException('Empty key');
            }
            return $item->{$this->key};
        }
        throw new \InvalidArgumentException('Invalid list');
    }

    /**
     * @return Traversable<TKey, TValue>
     */
    public function getIterator(): Traversable
    {
        return new \ArrayIterator($this->map);
    }

    /**
     * @param TKey $offset
     * @return bool
     */
    public function offsetExists(mixed $offset): bool
    {
        return isset($this->map[$offset]);
    }

    /**
     * @param TKey $offset
     * @return null|TValue
     */
    public function offsetGet(mixed $offset): mixed
    {
        if (isset($this->map[$offset])) {
            return $this->map[$offset];
        }
        return null;
    }

    /**
     * @param TKey $offset
     * @param TValue $value
     * @return void
     */
    public function offsetSet(mixed $offset, mixed $value): void
    {
        // check type is valid for existing map
        $this->validateType($value);
        $this->map[$offset] = $value;
        $this->sort();
    }

    /**
     * Removing an item should not affect sort order
     *
     * @param TKey $offset
     * @return void
     */
    public function offsetUnset(mixed $offset): void
    {
        unset($this->map[$offset]);
    }

    public function count(): int
    {
        return count($this->map);
    }

    public function jsonSerialize(): array
    {
        $values = array_values($this->map);
        if (empty($values)) {
            $values = [];
        }
        return $values;
    }

    /**
     * When trying to cast a map to array e.g. (array) $map
     * It won't work...
     * We need a specific method
     * @return array
     */
    public function toArray(): array
    {
        $arr = [];
        foreach ($this->map as $v) {
            $arr[] = $v;
        }
        return $arr;
    }

    /**
     * Sorts data by key and sets map to the same order
     * @return void
     */
    public function sort(): void
    {
        ksort($this->map, SORT_REGULAR);
    }
}
