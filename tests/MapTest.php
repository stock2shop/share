<?php

declare(strict_types=1);

namespace Stock2Shop\Tests\Share;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO;
use Stock2Shop\Share\Map;

class MapTest extends TestCase
{
    const KEY = 'key';

    const LIST_OF_ARRAYS = [
        ['key' => 'foo', 'value' => '1', 'template_name' => null],
        ['key' => 'bar', 'value' => '2', 'template_name' => null],
        ['key' => 'baz', 'value' => '3', 'template_name' => null],
    ];

    const LIST_OF_ARRAYS_SORTED = [
        self::LIST_OF_ARRAYS[1],
        self::LIST_OF_ARRAYS[2],
        self::LIST_OF_ARRAYS[0],
    ];

    const KEYS_IN_LIST_SORTED = [
        'bar',
        'baz',
        'foo'
    ];
    const VALUES_IN_LIST_SORTED = [
        '2',
        '3',
        '1'
    ];

    /**
     * @dataProvider constructorDataProvider
     * @param array $data
     * @return void
     */
    public function testConstructor(array $data): void
    {
        $iterator = new Map($data, self::KEY);
        $this->assertSortedIterationAndArrayAccess(
            self::KEYS_IN_LIST_SORTED,
            self::VALUES_IN_LIST_SORTED,
            $iterator
        );

        // unset
        unset($iterator['baz']);
        $this->assertSortedIterationAndArrayAccess(
            [self::KEYS_IN_LIST_SORTED[0], self::KEYS_IN_LIST_SORTED[2]],
            [self::VALUES_IN_LIST_SORTED[0], self::VALUES_IN_LIST_SORTED[2]],
            $iterator
        );

        // add back value
        if(is_array($iterator['bar'])) {
            $iterator['baz'] = self::LIST_OF_ARRAYS[2];
        } else {
            $iterator['baz'] = new DTO\Meta(self::LIST_OF_ARRAYS[2]);
        }
        $this->assertSortedIterationAndArrayAccess(
            self::KEYS_IN_LIST_SORTED,
            self::VALUES_IN_LIST_SORTED,
            $iterator
        );

        // json serialization
        $json = json_encode($iterator);
        $arr  = json_decode($json, true);
        $this->assertEquals(self::LIST_OF_ARRAYS_SORTED, $arr);
    }

    /**
     * check loop, results should be sorted by key
     * should return key value (value being the object or array)
     *
     * @param string[] $expected_keys
     * @param string[] $expected_values
     * @param Map $iterator
     * @return void
     */
    private function assertSortedIterationAndArrayAccess(
        array $expected_keys,
        array $expected_values,
        Map $iterator
    ): void {
        $cnt = 0;
        foreach ($iterator as $k => $v) {
            $this->assertEquals($expected_keys[$cnt] ?? '', $k);
            if (is_array($v)) {
                $value = $v['value'];
            } else {
                $value = $v->value;
            }
            $this->assertEquals($expected_values[$cnt] ?? '', $value);

            // access via array key
            $item = $iterator[$k];
            if (is_array($v)) {
                $value = $item['value'];
            } else {
                $value = $item->value;
            }
            $this->assertEquals($expected_values[$cnt] ?? '', $value);
            $cnt++;
        }

        // count should work
        $this->assertEquals(count($expected_keys), $cnt);
        $this->assertCount(count($expected_keys), $iterator);
    }

    private function constructorDataProvider(): \Generator
    {
        yield 'list of arrays' => [
            self::LIST_OF_ARRAYS
        ];
        yield 'list of objects' => [
            [
                new DTO\Meta(self::LIST_OF_ARRAYS[0]),
                new DTO\Meta(self::LIST_OF_ARRAYS[1]),
                new DTO\Meta(self::LIST_OF_ARRAYS[2])
            ]
        ];
    }

    public function testArrayCast(): void {
        $map = new Map(self::LIST_OF_ARRAYS, self::KEY);
        $cast = $map->toArray();
        $this->assertEquals(self::LIST_OF_ARRAYS_SORTED, $cast);
    }

    public function testBadTypes(): void {
        $this->expectException(InvalidArgumentException::class);
        $data     = [];
        $iterator = new Map($data, self::KEY);
        $iterator['x'] = new DTO\Meta(self::LIST_OF_ARRAYS[0]);
        $iterator['y'] = new DTO\OrderMeta(self::LIST_OF_ARRAYS[1]);
    }

    public function testNullOrEmpty(): void
    {
        // null key with a value
        $data     = [];
        $iterator = new Map($data, self::KEY);
        $json     = json_encode($iterator);
        $arr      = json_decode($json, true);
        $this->assertEquals([], $arr);

        // non existent
        $this->assertNull($iterator['missing']);

        // count
        $this->assertCount(0, $iterator);
        $cnt = 0;
        foreach ($iterator as $meta) {
            $cnt++;
        }
        $this->assertEquals(0, $cnt);
    }

    /**
     * @dataProvider invalidArgumentExceptionDataProvider
     * @param array $data
     * @return void
     */
    public function testInvalidArgumentException(array $data)
    {
        $this->expectException(InvalidArgumentException::class);
        new Map($data, self::KEY);
    }

    private function invalidArgumentExceptionDataProvider(): \Generator
    {
        yield 'missing key' => [
            [['value' => 'foo']]
        ];
        yield 'duplicate key' => [
            [
                ['key' => 'x', 'value' => 'foo'],
                ['key' => 'x', 'value' => 'bar'],
            ]
        ];
        yield 'incompatible values' => [
            [
                ['key' => 'x', 'value' => 'foo'],
                new DTO\Meta(['key' => 'y', 'value' => 'bar']),
            ]
        ];
        yield 'incompatible values switched' => [
            [
                new DTO\Meta(['key' => 'y', 'value' => 'bar']),
                ['key' => 'x', 'value' => 'foo'],
            ]
        ];
        yield 'incompatible values object type' => [
            [
                new DTO\Meta(['key' => 'y', 'value' => 'bar']),
                new DTO\OrderMeta(['key' => 'y', 'value' => 'bar']),
            ]
        ];
    }
}
