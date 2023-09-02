<?php

declare(strict_types=1);

namespace Stock2Shop\Share\Utils;

use Stock2Shop\Share\IteratorInterface;
use Traversable;

/**
 * Turns a list into a map, keyed on a specific property.
 * Unlike php array access, the key used to access the array is case-insensitive.
 * Keys are converted to lowercase.
 *
 * e.g.
 * <code>
 * $map = new Map(['key' => 'A', 'value' => 'b']);
 * $b = $map['a']->value;
 * </code>
 *
 * The list can be any object or array with a unique key property.
 * The map must consist of the same objects or arrays.
 *
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
     * @param string $key_property
     */
    public function __construct(array $data, private readonly string $key_property)
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
     * @param bool $trim
     * @return TKey
     */
    private function getKey(mixed $item, bool $trim = true): mixed
    {
        if (is_array($item)) {
            if (
                !isset($item[$this->key_property])) {
                throw new \InvalidArgumentException('Empty key');
            }
            return ($trim) ? $this->trimToLower($item[$this->key_property]) : $item[$this->key_property];
        } elseif (is_object($item)) {
            if (!isset($item->{$this->key_property})) {
                throw new \InvalidArgumentException('Empty key');
            }
            return ($trim) ? $this->trimToLower($item->{$this->key_property}) : $item->{$this->key_property};
        }
        throw new \InvalidArgumentException('Invalid list');
    }

    /**
     * @return Traversable<TKey, TValue>
     */
    public function getIterator(): Traversable
    {
        // set original key (which does not change casing)
        $data = [];
        foreach ($this->map as $v) {
            $data[$this->getKey($v, false)] = $v;
        }
        return new \ArrayIterator($data);
    }

    /**
     * @param TKey $offset
     * @return bool
     */
    public function offsetExists(mixed $offset): bool
    {
        $key = $this->trimToLower($offset);
        return isset($this->map[$key]);
    }

    /**
     * @param TKey $offset
     * @return null|TValue
     */
    public function offsetGet(mixed $offset): mixed
    {
        $key = $this->trimToLower($offset);
        if (isset($this->map[$key])) {
            return $this->map[$key];
        }
        return null;
    }

    /**
     * @param TKey|null $offset
     * @param TValue $value
     * @return void
     */
    public function offsetSet(mixed $offset, mixed $value): void
    {
        // check type is valid for existing map
        $this->validateType($value);

        // Null offset might arise when appending:
        // $map[] = $object;
        // To support append try figure out the key from the object.
        $key = $this->getKey($value);

        // if the key is given, it should match the key from the object
        if (!is_null($offset)) {
            if ($key !== $this->trimToLower($offset)) {
                throw new \InvalidArgumentException('Invalid Key');
            }
        }
        $this->map[$key] = $value;
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
        $key = $this->trimToLower($offset);
        unset($this->map[$key]);
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
            $arr[] = (array)$v;
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

    /**
     * @return array<int, TKey>
     */
    public function getKeys(): array
    {
        $arr = [];
        foreach ($this->map as $v) {
            $arr[] = $this->getKey($v, false);
        }
        return $arr;
    }

    private function trimToLower(mixed $val)
    {
        return (is_string($val)) ? trim(strtolower($val)) : $val;
    }
}
