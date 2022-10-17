<?php

declare(strict_types=1);

namespace Stock2Shop\Tests\Share\Log;

use Monolog\Formatter\JsonFormatter as JsonFormatterParent;
use Monolog\Test\TestCase;
use Stock2Shop\Share\Log\JsonFormatter;
use Stock2Shop\Share\Utils\Date;

class JsonFormatterTest extends TestCase
{
    public function testFormat()
    {
        $formatter         = new JsonFormatter();
        $record            = $this->getRecord();
        $record['context'] = [
            'foo' => 'bar',
            'baz' => 'bat'
        ];
        $this->assertEquals(
            sprintf(
                '{"level":"warning","message":"test","created":"%s","foo":"bar","baz":"bat"}%s',
                Date::getDate((string)$record['datetime']),
                "\n"
            ),
            $formatter->format($record)
        );

        $formatter = new JsonFormatter(JsonFormatterParent::BATCH_MODE_JSON, false);
        $record    = $this->getRecord();
        $this->assertEquals(
            sprintf(
                '{"level":"warning","message":"test","created":"%s"}',
                Date::getDate((string)$record['datetime'])
            ),
            $formatter->format($record)
        );
    }

}
