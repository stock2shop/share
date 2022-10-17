<?php

declare(strict_types=1);

namespace Stock2Shop\Share\Utils;

use DateTime;
use DateTimeZone;
use Exception;
use InvalidArgumentException;

class Date
{
    public const FORMAT = "Y-m-d H:i:s";
    public const FORMAT_MS = "Y-m-d H:i:s.u";
    public const TIMEZONE = "UTC";

    /**
     * Returns date as ISO8601 string including microseconds.
     * Timezone UTC
     */
    public static function getDBDate(string $date_str = ''): string
    {
        date_default_timezone_set(self::TIMEZONE);
        try {
            $d = new DateTime($date_str);
        } catch (Exception $e) {
            throw new InvalidArgumentException();
        }
        $d->setTimeZone(new DateTimeZone(self::TIMEZONE));
        return $d->format(self::FORMAT_MS);
    }

    /**
     * Returns date as ISO8601 string (without the T) excluding microseconds.
     * Timezone UTC
     */
    public static function getDate(string $date_str = ''): string
    {
        date_default_timezone_set(self::TIMEZONE);
        try {
            $d = new DateTime($date_str);
        } catch (Exception $e) {
            throw new InvalidArgumentException();
        }
        $d->setTimeZone(new DateTimeZone(self::TIMEZONE));
        return $d->format(self::FORMAT_MS);
    }

    public static function getInvertedTimestamp(): int
    {
        $nano = 1000000000;
        $now  = microtime(true);
        $ref  = 9000000000000000000;
        $t    = (int)($now * $nano);
        return $ref - $t;
    }
}
