<?php

declare(strict_types=1);

namespace Stock2Shop\Share\Log;

use \Monolog\Formatter;
use Stock2Shop\Share\Utils\Date;

class JsonFormatter extends Formatter\JsonFormatter
{
    public function format(array $record): string
    {
        $record = $this->normalize($record);
        // Transform record to be consistent with Stock2Shop.
        // Property names must be the same.
        // No nesting is allowed
        $newRecord = [];
        $newRecord['level'] = strtolower($record['level_name']);
        $newRecord['message'] = $record['message'];
        $newRecord['created'] = Date::getDate($record['datetime']);
        foreach ($record["context"] as $key => $value) {
            $newRecord[$key] = $value;
        }
        return $this->toJson($newRecord, true) . ($this->appendNewline ? "\n" : '');
    }

}