<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

use InvalidArgumentException;
use JsonSerializable;
use Stock2Shop\Share\Utils\Date;
use Stock2Shop\Share\Utils\Map;

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

    /**
     * Creates a array from a Map or array
     * @param array $data
     * @param string $key
     * @return array
     */
    public static function arrayFrom(array $data, string $key): array
    {
        if (!array_key_exists($key, $data)) {
            return [];
        }
        if (empty($data[$key])) {
            return [];
        }
        if (is_array($data[$key])) {
            return $data[$key];
        } elseif (
            $data[$key] instanceof Map ||
            $data[$key] instanceof DTO
        ) {
            return $data[$key]->toArray();
        } else {
            throw new InvalidArgumentException('value is not an array or map');
        }
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
        return $this->toArray();
    }

    /**
     * Creates concrete DTO instance from JSON string.
     * @param string $json
     * @return static
     */
    public static function createFromJSON(string $json): static
    {
        $data = json_decode($json, true);
        /** @psalm-suppress TooManyArguments */
        return new static($data);
    }

    /**
     * Converts DTO to an array
     * @return array
     */
    public function toArray(): array
    {
        return $this->dto_to_array($this);
    }

    /**
     * Recursively cast to array
     * @param mixed $dto
     * @return array
     */
    protected function dto_to_array(mixed $dto): array
    {
        $ret = (array)$dto;
        foreach ($ret as &$item) {
            // for maps (custom iterators) we need to cast each
            // property into an array manually
            // "(array) $map" wont work here...
            if ($item instanceof Map) {
                $item = $item->toArray();
            }
            if (!empty($item)) {
                if (is_object($item) || is_array($item)) {
                    $item = $this->dto_to_array($item);
                }
            }
        }
        return $ret;
    }

    /**
     * Creates an array of concrete instances
     * @param array $data
     * @return static[]
     */
    public static function createArray(array $data): array
    {
        $a = [];
        foreach ($data as $item) {
            /** @psalm-suppress TooManyArguments */
            $a[] = new static((array)$item);
        }
        return $a;
    }
}
