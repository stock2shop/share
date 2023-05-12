<?php

declare(strict_types=1);

namespace Stock2Shop\Tests\Share\Utils;

use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO;
use Stock2Shop\Share\DTO\Maps\Metas;
use Stock2Shop\Share\Utils\Meta;

class MetaTest extends TestCase
{
    private static array $meta = [
        [
            'key' => 'true_1',
            'value' => 'True '
        ],
        [
            'key' => 'true_2',
            'value' => ' 1'
        ],
        [
            'key' => 'true_3',
            'value' => '1'
        ],
        [
            'key' => 'false_1',
            'value' => '12'
        ],
        [
            'key' => 'false_2',
            'value' => ''
        ],
        [
            'key' => 'false_3',
            'value' => null
        ]
    ];

    /**
     * @dataProvider IsTrueDataProvider
     */
    public function testIsTrue(Metas $meta, string $key, bool $expects): void
    {
        $bool = Meta::isTrue($meta, $key);
        $this->assertEquals($expects, $bool);
    }

    /**
     * @dataProvider GetValueDataProvider
     */
    public function testGetValue(Metas $meta, string $key, ?string $expects): void
    {
        $bool = Meta::isTrue($meta, $key);
        $this->assertEquals($expects, $bool);
    }

    private function GetValueDataProvider(): array
    {
        $meta = new Metas(self::$meta);
        return [
            [
                $meta,
                'true_1',
                $meta['true_1']->value
            ],
            [
                $meta,
                'true_2',
                $meta['true_2']->value
            ],
            [
                $meta,
                'false_3',
                null
            ],
            [
                $meta,
                '',
                null
            ],
        ];
    }

    private function IsTrueDataProvider(): array
    {
        $meta = DTO\Meta::createArray(self::$meta);
        return [
            [
                $meta,
                'true_1',
                true
            ],
            [
                $meta,
                'true_2',
                true
            ],
            [
                $meta,
                'true_3',
                true
            ],
            [
                $meta,
                'false_1',
                false
            ],
            [
                $meta,
                'false_2',
                false
            ],
            [
                $meta,
                'false_3',
                false
            ],
            [
                $meta,
                '',
                false
            ],
        ];
    }
}
