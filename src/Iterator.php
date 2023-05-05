<?php

declare(strict_types=1);

namespace Stock2Shop\Share;

use Traversable;

/**
 * @template T
 * @implements IteratorInterface<T>
 */
class Iterator implements IteratorInterface
{
    /**
     * @var array<string, T>
     */
    private array $map = [];

    /**
     * @param array<int, T> $data
     */
    public function __construct(private array &$data, private readonly string $key)
    {
        $this->sort();
    }

    /**
     * Resets map from data
     * @return void
     */
    private function setMap(): void
    {
        $this->map = [];
        foreach ($this->data as $item) {
            $this->map[$item->{$this->key}] = $item;
        }
    }

    /**
     * @return Traversable<string, T>
     */
    public function getIterator(): Traversable
    {
        return new \ArrayIterator($this->map);
    }

    /**
     * @param string $offset
     * @return bool
     */
    public function offsetExists(mixed $offset): bool
    {
        return isset($this->map[$offset]);
    }

    /**
     * @param string $offset
     * @return null|T
     */
    public function offsetGet(mixed $offset): mixed
    {
        if (isset($this->map[$offset])) {
            return $this->map[$offset];
        }
        return null;
    }

    /**
     * @param string $offset
     * @param T $value
     * @return void
     */
    public function offsetSet(mixed $offset, mixed $value): void
    {
        foreach ($this->data as $item) {
            if ($item->{$this->key} === $offset) {
                $item->{$this->key} = $value;
                break;
            }
        }
        $this->map[$offset ?? ''] = $value;
    }

    /**
     * @param string $offset
     * @return void
     */
    public function offsetUnset(mixed $offset): void
    {
        foreach ($this->data as $k => $item) {
            if ($item->{$this->key} === $offset) {
                array_splice($this->data, $k, 1);
                break;
            }
        }
        unset($this->map[$offset]);
    }

    public function count(): int
    {
        return count($this->map);
    }

    public function jsonSerialize(): mixed
    {
        return $this->data;
    }

    /**
     * Sorts data by key and sets map to the same order
     * @return void
     */
    public function sort(): void
    {
        $key = $this->key;
        usort($this->data, function ($a, $b) use ($key) {
            return $a->{$key} <=> $b->{$key};
        });
        $this->setMap();
    }
}
