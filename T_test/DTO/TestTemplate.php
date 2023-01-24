<?php

declare(strict_types=1);

namespace Stock2Shop\Test\Share\DTO;
use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO\{{ClassName}};

class {{ClassName}}Test extends TestCase
{
    private function setUpArray(): array
    {
        $array = [

        ];
        return $array;
    }

    private function setUpJson(): string
    {
        $json = '{
            
        }';
        return $json;
    }
    
    public function testClassConstructor(): void{ }
    public function testSerialize(): void { }
    public function testJsonConversion(): void { }
    public function testArrayConversion(): void { }

    /** @dataProvider computeHash */
    public function testComputeHash(array $object, string $expectedValue): void { }

    /** @dataProvider computeHash_null */
    public function testComputeHash_null(array $object, string $expectedValue): void { }
    private function computeHash(): array { }
    private function computeHash_null(): array { }
    
}

?>