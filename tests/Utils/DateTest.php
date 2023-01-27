<?php

namespace Stock2Shop\Test\Share\Utils;

use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\Utils\Date;
use DateTime as dt;

class DateTest extends TestCase
{
    public function testGetDateString()
    {
        //String
        $date = "2023-01-25 11:31:00.000000";

        $new_date = Date::getDateString($date);
        $this->assertSame("2023-01-25 11:31:00.000000", $new_date);

        //DateTime object
        $date = new dt("2023-01-25 11:43:00.000000");   

        $new_date = Date::getDateString($date);
        $this->assertSame("2023-01-25 11:43:00.000000", $new_date);
    }
}

?>