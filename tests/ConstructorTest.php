<?php

declare(strict_types=1);

namespace Stock2Shop\Tests\Share;

use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO;

class ConstructorTest extends TestCase
{

    /**
     * @dataProvider constructProvider
     * @param class-string<DTO\DTOInterface> $class
     * @param array $data
     * @return void
     */
    public function testConstruct(string $class, array $data): void
    {
        $c      = new $class($data);
        $result = json_decode(json_encode($c), true);
        $this->assertEquals($data, $result);
    }

    private function constructProvider(): \Generator
    {
        foreach (scandir(__DIR__) as $file) {
            if (str_contains($file, '.json')) {
                $class    = 'Stock2Shop\\Share\\DTO\\' . str_replace('.json', '', $file);
                $contents = json_decode(
                    file_get_contents(__DIR__ . '/' . $file),
                    true
                );
                yield $class => [
                    $class,
                    $contents
                ];
            }
        }
    }
}
