<?php

declare(strict_types=1);

namespace Stock2Shop\Share\Utils;

use DateTime;
use DateTimeZone;
use Exception;
use InvalidArgumentException;

class Date
{
    // might not need FORMAT without microseconds
    public const FORMAT = "Y-m-d H:i:s";
    public const FORMAT_MS = "Y-m-d H:i:s.u";
    public const TIMEZONE = "UTC";

    /**
     * Returns date string as ISO8601 string (without the T).
     * Format options include with milliseconds or not.
     * 2022-10-10 10:30:40
     * 2022-10-10 10:30:40.123456
     *
     * Sets timezone UTC
     * Accepts DateTime object or any valid Date String
     * https://www.php.net/manual/en/datetime.formats.php
     * @param string|DateTime $date
     */
    public static function getDateString($date = '', $format = self::FORMAT_MS): string
    {
        if ($format != self::FORMAT_MS && $format != self::FORMAT) {
                throw new InvalidArgumentException('Invalid Date Format');
        }
        date_default_timezone_set(self::TIMEZONE);
        if (is_string($date)) {
            try {
                $d = new DateTime($date);
            } catch (Exception $e) {
                throw new InvalidArgumentException();
            }
        } else {
            if ($date instanceof DateTime) {
                $d = $date;
            } else {
                throw new InvalidArgumentException('Invalid date');
            }
        }
        $d->setTimeZone(new DateTimeZone(self::TIMEZONE));
        return $d->format($format);
    }
}
