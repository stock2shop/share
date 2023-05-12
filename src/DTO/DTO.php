<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

use InvalidArgumentException;
use JsonSerializable;
use Stock2Shop\Share\Utils\Date;

abstract class DTO implements JsonSerializable, DTOInterface
{
    /**
     * Sorts a multidimensional array by key name.
     *
     * WARNING The $sortable array must be passed by reference
     * https://stackoverflow.com/a/10483117
     */
    protected function sortArray(array &$sortable, string $keyName): array
    {
        usort($sortable, function ($a, $b) use ($keyName) {
            return $a->$keyName <=> $b->$keyName;
        });
        return $sortable;
    }

    protected function sortCSV(?string $str): ?string
    {
        if (is_null($str)) {
            return null;
        }
        $sortable = explode(',', $str);
        usort($sortable, function ($a, $b) {
            return $a <=> $b;
        });
        return implode(",", $sortable);
    }

    public static function boolFrom(array $data, string $key): ?bool
    {
        if (array_key_exists($key, $data)) {
            return self::toBool($data[$key]);
        }
        return null;
    }

    public static function stringFrom(array $data, string $key): ?string
    {
        if (array_key_exists($key, $data)) {
            return self::toString($data[$key]);
        }
        return null;
    }

    /**
     * Accepts string or DateTime value
     * Returns date string as ISO8601 string (without the T).
     * Format options include with milliseconds or not.
     * 2022-10-10 10:30:40
     * 2022-10-10 10:30:40.123456
     *
     * Sets timezone UTC
     * Accepts DateTime object or any valid Date String
     * https://www.php.net/manual/en/datetime.formats.php
     */
    public static function dateStringFrom(array $data, string $key, string $format): ?string
    {
        if (array_key_exists($key, $data)) {
            if (empty($data[$key])) {
                return self::toString($data[$key]);
            }
            return Date::getDateString($data[$key], $format);
        }
        return null;
    }

    /**
     * "There is no difference in PHP.
     * float, double or real are the same datatype.
     * At the C level, everything is stored as a double"
     * https://stackoverflow.com/a/3280927/639133
     *
     * @throws InvalidArgumentException
     */
    public static function floatFrom(array $data, string $key): ?float
    {
        if (array_key_exists($key, $data)) {
            return self::toFloat($data[$key]);
        }
        return null;
    }

    public static function intFrom(array $data, string $key): ?int
    {
        if (array_key_exists($key, $data)) {
            return self::toInt($data[$key]);
        }
        return null;
    }

    public static function arrayFrom(array $data, string $key): array
    {
        if (array_key_exists($key, $data)) {
            switch (gettype($data[$key])) {
                case "object":
                    return (array)$data[$key];
                case "array":
                    return $data[$key];
            }
        }
        return [];
    }

    private static function toBool($arg): ?bool
    {
        if (is_null($arg)) {
            return null;
        }
        if (is_bool($arg)) {
            return $arg;
        }
        if (is_string($arg)) {
            $s = strtolower($arg);
            if ($s === "false") {
                return false;
            }
            if ($s === "0") {
                return false;
            }
            if ($s === "") {
                return false;
            }
            return true;
        }
        if (is_numeric($arg)) {
            if ((int)$arg === 0) {
                return false;
            }
            return true;
        }
        return (bool)$arg;
    }

    private static function toFloat($arg): ?float
    {
        if (is_null($arg)) {
            return null;
        }
        if (is_string($arg)) {
            if (!is_numeric($arg)) {
                if (trim($arg) === "") {
                    return null;
                }
                throw new InvalidArgumentException(
                    "value is not numeric"
                );
            }
        }
        if (is_bool($arg)) {
            throw new InvalidArgumentException("value is a bool");
        }
        return (float)$arg;
    }

    private static function toString($arg): ?string
    {
        if (is_null($arg)) {
            return null;
        }
        if (is_bool($arg)) {
            if (!$arg) {
                return "false";
            }
            return "true";
        }
        return (string)$arg;
    }

    private static function toInt($arg): ?int
    {
        $num = self::toFloat($arg);
        if (is_null($num)) {
            return null;
        }
        return (int)$num;
    }

    public function jsonSerialize(): array
    {
        return (array)$this;
    }
}
