<?php

declare(strict_types=1);

namespace Stock2Shop\Share\Utils;

use Stock2Shop\Share\DTO;

class Meta
{
    /**
     * returns value for key.
     * Key is case-insensitive
     * @param DTO\Meta[] $meta
     */
    public static function getValue(array $meta, string $key): ?string
    {
        foreach ($meta as $item) {
            if (strtolower($item->key) === strtolower($key)) {
                return $item->value;
            }
        }
        return null;
    }

    /**
     * Check if the value of the meta (which is a string) is true
     * "true" or "1" is truthy, everything else is falsy.
     * @param DTO\Meta[] $meta
     */
    public static function isTrue(array $meta, string $key): bool
    {
        foreach ($meta as $item) {
            if (
                is_null($item->key) ||
                is_null($item->value)
            ) {
                continue;
            }
            if (strtolower($item->key) === strtolower($key)) {
                if (
                    strtolower(trim($item->value)) === 'true' ||
                    trim($item->value) === '1'
                ) {
                    return true;
                }
                break;
            }
        }
        return false;
    }
}
