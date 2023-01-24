<?php

declare(strict_types=1);

namespace Stock2Shop\Test\Share\DTO;
use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO\Image;

class ImageTest extends TestCase
{
    private function setUpArray(): array
    { 
        $array = [
            "src" => "source"
        ];
        return $string;
    }

    private function setUpJson(): string
    { 
        $json = '{
            "src": "source"
        }';
        return $json;
    }
    
    public function testJsonConversion(): void 
    { 
        $json = $this->setUpJson();
        $array = json_encode(Image::createFromJSON($json));

        $this->assertJsonStringEqualsJsonString($json, $array);
    }

    public function testArrayConversion(): void 
    { 
        $array = [
            [
                "src" => "source"
            ],
            [
                "src" => null
            ]
        ];

        $json = '[{
            "src": "source"
        }, 
        {
            "src": null
        }]';

        $json = json_encode(Image::createArray($array));

        $this->assertJsonStringEqualsJsonString(json_encode($array), $json);
    }
}

?>