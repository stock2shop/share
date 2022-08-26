<?php

namespace Stock2Shop\Share\DTO;

use InvalidArgumentException;

abstract class AbstractBase
{
    /**
     * Creates an array of class instances, instantiated with data.
     *
     * @param array $data
     * @return array
     */
    static function createArray(array $data): array
    {
        $a = [];
        foreach ($data as $item) {
            $r = new \ReflectionClass(get_called_class());
            try {
                $a[]  = $r->newInstance($item);
            } catch(\ReflectionException $e) {
            }
        }
        return $a;
    }

    /**
     * Sorts a multidimensional array by key name.
     *
     * WARNING The $sortable array must be passed by reference
     * https://stackoverflow.com/a/10483117
     *
     * @param array $sortable
     * @param string $keyName
     */
    protected function sortArray(array &$sortable, string $keyName)
    {
        usort($sortable, function ($a, $b) use ($keyName) {
            return $a->$keyName <=> $b->$keyName;
        });
    }

    /**
     * Sorts a csv string
     *
     * @param string $str
     */
    protected function sortCSV(string &$str)
    {
        $sortable = explode(',', $str);
        usort($sortable, function ($a, $b) {
            return $a <=> $b;
        });
        $str = implode(",", $sortable);
    }

    /**
     * @param array $data
     * @param string $key
     * @return bool|null Value of key if it exists
     */
    static function boolFrom(array $data, string $key)
    {
        if (array_key_exists($key, $data)) {
            return self::toBool($data[$key]);
        }
        return null;
    }

    /**
     * @param array $data
     * @param string $key
     * @return string|null Value of key if it exists
     */
    static function stringFrom(array $data, string $key)
    {
        if (array_key_exists($key, $data)) {
            return self::toString($data[$key]);
        }
        return null;
    }

    /**
     * "There is no difference in PHP.
     * float, double or real are the same datatype.
     * At the C level, everything is stored as a double"
     * https://stackoverflow.com/a/3280927/639133
     * @param array $data
     * @param string $key
     * @return float|null Value of key if it exists
     */
    static function floatFrom(array $data, string $key)
    {
        if (array_key_exists($key, $data)) {
            return self::toFloat($data[$key]);
        }
        return null;
    }

    /**
     * @param array $data
     * @param string $key
     * @return int|null Value of key if it exists
     */
    static function intFrom(array $data, string $key)
    {
        if (array_key_exists($key, $data)) {
            return self::toInt($data[$key]);
        }
        return null;
    }

    /**
     * @param array $data
     * @param string $key
     * @return array Value of key if it exists,
     *  and can be converted to array, or empty array
     */
    static function arrayFrom(array $data, string $key): array
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

    /**
     * @param $arg
     * @return int|null
     */
    static function toBool($arg)
    {
        if (is_null($arg)) {
            return null;
        }
        $type = gettype($arg);
        if ($type === "string") {
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
        if ($type === "integer") {
            if ($arg === 0) {
                return false;
            }
            return true;
        }
        if ($type === "double") {
            if ($arg === 0.0) {
                return false;
            }
            return true;
        }
        if ($type === "boolean") {
            return $arg;
        }
    }

    /**
     * @param $arg
     * @return int|null
     */
    static function toFloat($arg)
    {
        if (is_null($arg)) {
            return null;
        }
        $type = gettype($arg);
        if ($type === "string") {
            if (!is_numeric($arg)) {
                if (trim($arg) === "") {
                    return null;
                }
                throw new InvalidArgumentException(
                    "value is not numeric"
                );
            }
        }
        if ($type === "boolean") {
            throw new InvalidArgumentException("value is a bool");
        }
        return (float)$arg;
    }

    /**
     * @param $arg
     * @return string|null
     */
    static function toString($arg)
    {
        if (is_null($arg)) {
            return null;
        }
        if (gettype($arg) === "boolean") {
            if ($arg === false) {
                return "false";
            }
            return "true";
        }
        return (string)$arg;
    }

    /**
     * @param $arg
     * @return int|null
     */
    static function toInt($arg)
    {
        if (is_null($arg)) {
            return null;
        }
        $num = self::toFloat($arg);
        if (is_null($num)) {
            return null;
        }
        return (int)$num;
    }

}
