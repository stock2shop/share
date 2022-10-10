<?php
declare(strict_types=1);

namespace Stock2Shop\Tests\Share\DTO;

use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO\DTO;

class DTOTest extends TestCase
{
    public function testBoolFrom()
    {
        // string
        // These are the falsy values
        $this->assertFalse(DTO::boolFrom(["v"=>"false"], "v"));
        $this->assertFalse(DTO::boolFrom(["v"=>"0"], "v"));
        $this->assertFalse(DTO::boolFrom(["v"=>""], "v"));
        // All other strings are true
        $this->assertTrue(DTO::boolFrom(["v"=>"true"], "v"));
        $this->assertTrue(DTO::boolFrom(["v"=>"TRUE"], "v"));
        $this->assertTrue(DTO::boolFrom(["v"=>"1"], "v"));
        $this->assertTrue(DTO::boolFrom(["v"=>"2"], "v"));
        $this->assertTrue(DTO::boolFrom(["v"=>"asdf"], "v"));

        // integer
        $this->assertFalse(DTO::boolFrom(["v"=>0], "v"));
        $this->assertTrue(DTO::boolFrom(["v"=>1], "v"));
        $this->assertTrue(DTO::boolFrom(["v"=>-1], "v"));

        // double
        $this->assertFalse(DTO::boolFrom(["v"=>0.0], "v"));
        $this->assertTrue(DTO::boolFrom(["v"=>1.2], "v"));
        $this->assertTrue(DTO::boolFrom(["v"=>-1.2], "v"));

        // bool
        $this->assertFalse(DTO::boolFrom(["v"=>false], "v"));
        $this->assertTrue(DTO::boolFrom(["v"=>true], "v"));

        // null remains null
        $this->assertNull(DTO::boolFrom(["v"=>null], "v"));
        // Missing properties parse as null
        $this->assertNull(DTO::boolFrom([], "v"));
    }

    public function testStringFrom() {
        // string
        $this->assertSame("123", DTO::stringFrom(["v"=>"123"], "v"));

        // integer
        $this->assertSame("123", DTO::stringFrom(["v"=>123], "v"));
        $this->assertSame("-123", DTO::stringFrom(["v"=>-123], "v"));

        // double
        $this->assertSame(
            "123.45", DTO::stringFrom(["v"=>123.45], "v"));
        $this->assertSame(
            "-123.45", DTO::stringFrom(["v"=>-123.45], "v"));

        // bool
        $this->assertSame(
            "false", DTO::stringFrom(["v"=>false], "v"));
        $this->assertSame("true", DTO::stringFrom(["v"=>true], "v"));

        // null remains null
        $this->assertNull(DTO::stringFrom(["v"=>null], "v"));
        // Missing properties parse as null
        $this->assertNull(DTO::stringFrom([], "v"));
    }

    public function testIntFrom() {
        // string
        $this->assertSame(123, DTO::intFrom(["v"=>"123"], "v"));
        $exception = false;
        try {
            DTO::intFrom(["v"=>"0x539"], "v");
        } catch (\Exception) {
            $exception = true;
        }
        $this->assertTrue($exception);

        // integer
        $this->assertSame(123, DTO::intFrom(["v"=>123], "v"));
        $this->assertSame(-123, DTO::intFrom(["v"=>-123], "v"));

        // double
        $this->assertSame(
            123, DTO::intFrom(["v"=>123.45], "v"));
        $this->assertSame(
            -123, DTO::intFrom(["v"=>-123.45], "v"));

        // bool
        $exception = false;
        try {
            DTO::intFrom(["v"=>false], "v");
        } catch (\Exception) {
            $exception = true;
        }
        $this->assertTrue($exception);
        $exception = false;
        try {
            DTO::intFrom(["v"=>true], "v");
        } catch (\Exception) {
            $exception = true;
        }
        $this->assertTrue($exception);

        // null remains null
        $this->assertNull(DTO::intFrom(["v"=>null], "v"));
        // Missing properties parse as null
        $this->assertNull(DTO::intFrom([], "v"));
    }

    public function testFloatFrom() {
        // string
        $this->assertSame(123.45, DTO::floatFrom(["v"=>"123.45"], "v"));
        $exception = false;
        try {
            DTO::floatFrom(["v"=>"0x539"], "v");
        } catch (\Exception) {
            $exception = true;
        }
        $this->assertTrue($exception);

        // integer
        $this->assertSame(123.0, DTO::floatFrom(["v"=>123], "v"));
        $this->assertSame(-123.0, DTO::floatFrom(["v"=>-123], "v"));

        // double
        $this->assertSame(
            123.45, DTO::floatFrom(["v"=>123.45], "v"));
        $this->assertSame(
            -123.45, DTO::floatFrom(["v"=>-123.45], "v"));

        // bool
        $exception = false;
        try {
            DTO::floatFrom(["v"=>false], "v");
        } catch (\Exception) {
            $exception = true;
        }
        $this->assertTrue($exception);
        $exception = false;
        try {
            DTO::floatFrom(["v"=>true], "v");
        } catch (\Exception) {
            $exception = true;
        }
        $this->assertTrue($exception);

        // null remains null
        $this->assertNull(DTO::floatFrom(["v"=>null], "v"));
        // Missing properties parse as null
        $this->assertNull(DTO::floatFrom([], "v"));
    }

}
