<?php

declare(strict_types=1);

namespace Stock2Shop\Tests\Share;

use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO;

class IteratorTest extends TestCase
{
    /**
     * Iterator will sort these results on key, so "baz" should be first
     * @var array|array[]
     */
    private array $data = [
        ['key' => 'foo', 'value' => 'bar', 'template_name' => null],
        ['key' => 'baz', 'value' => 'qux', 'template_name' => null]
    ];

    public function testConstructor(): void
    {
        $iterator  = DTO\Meta::createIterable($this->data);

        // check loop, order preserved
        // should return key value (value being the dto)
        foreach ($iterator as $k => $v) {
            $this->assertTrue(in_array($k, ['foo', 'baz']));
            $this->assertInstanceOf('Stock2Shop\Share\DTO\Meta', $v);
            $this->assertTrue(in_array($v->value, ['bar', 'qux']));
        }

        // data should be sorted
        foreach ($iterator as $k => $v) {
            $this->assertEquals('baz', $k);
            $this->assertEquals(new DTO\Meta($this->data[1]), $v);
            break;
        }

        // should be able to access Meta via array key
        // TODO intellisense not picking up generic return type from offsetGet
        $this->assertEquals(new DTO\Meta($this->data[0]), $iterator['foo']);
        $this->assertEquals(new DTO\Meta($this->data[1]), $iterator['baz']);

        // count should work
        $this->assertCount(count($this->data), $iterator);

        // unset should work
        unset($iterator['foo']);
        $this->assertCount(count($this->data) - 1, $iterator);
        $this->assertEquals(new DTO\Meta($this->data[1]), $iterator['baz']);

        $i = 0;
        foreach ($iterator as $k => $v) {
            $this->assertNotEmpty($k);
            $this->assertNotEmpty($v);
            $i++;
        }
        $this->assertEquals(1, $i);

        // json serialization
        $json = json_encode($iterator);
        $arr = json_decode($json, true);
        $this->assertEquals([$this->data[1]], $arr);
    }

    public function testNullOrEmpty(): void
    {
        // null key with a value
        $data = ['value' => 'foo'];
        $iterator  = DTO\Meta::createIterable([$data]);
        $json = json_encode($iterator);
        $arr = json_decode($json, true);
        $this->assertEquals([(array) new DTO\Meta($data)], $arr);

        // non existent
        $this->assertNull($iterator['missing']);

        // count
        $this->assertCount(1, $iterator);

        // access null value with empty string...
        $this->assertEquals('foo', $iterator['']->value);
        foreach ($iterator as $k => $meta) {
            $this->assertEmpty($k);
            $this->assertEquals('foo', $meta->value);
        }

        // What about two null values?
        // TODO discuss what should happen here...
        $iterator  = DTO\Meta::createIterable([$data, $data]);
        $this->assertCount(1, $iterator);
    }
}
