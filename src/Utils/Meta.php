<?php

declare(strict_types=1);

namespace Stock2Shop\Share\Utils;

class Meta
{
    /**
     * returns value for key.
     * Key is case-insensitive
     * @param Map $meta
     * @param string $key
     * @return string|null
     */
    public static function getValue(Map $meta, string $key): ?string
    {
        $item = $meta[$key];
        if (is_null($item)) {
            return null;
        }
        return $item->value;
    }

    /**
     * Check if the value of the meta (which is a string) is true
     * "true" or "1" is truthy, everything else is falsy.
     * @param Map $meta
     * @param string $key
     * @return bool
     */
    public static function isTrue(Map $meta, string $key): bool
    {
        $item = $meta[$key];
        if (!is_null($item) && !is_null($item->value)) {
            if (
                strtolower(trim($item->value)) === 'true' ||
                trim($item->value) === '1'
            ) {
                return true;
            }
        }
        return false;
    }
}
