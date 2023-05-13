<?php

declare(strict_types=1);

namespace Stock2Shop\Tests\Share;

use PHPUnit\Framework\TestCase;
use ReflectionClass;
use ReflectionException;
use Stock2Shop\Share\DTO;

class ConstructorTest extends TestCase
{

    /**
     * Loops through all /mocks and serializes/deserializes to ensure results are the same.
     *
     * @dataProvider constructProvider
     * @param class-string<DTO\DTOInterface> $class
     * @param string $json
     * @return void
     */
    public function testConstruct(string $class, string $json): void
    {
        $data = json_decode($json, true);

        // create from json
        $c = $class::createFromJSON($json);
        $result = json_decode(json_encode($c), true);
        $this->assertEquals($data, $result);

        // using constructor
        $c      = new $class($data);
        $result = json_decode(json_encode($c), true);
        $this->assertEquals($data, $result);

        // check to array
        $arr = $c->toArray();
        $this->assertEquals($data, $arr);

        // using createArray
        $c = $class::createArray([$data]);
        $result = json_decode(json_encode($c), true);
        $this->assertEquals([$data], $result);
    }

    private function constructProvider(): \Generator
    {
        foreach (scandir(__DIR__ . '/mocks') as $file) {
            if (str_contains($file, '.json')) {
                $parts = explode('-', $file);
                $class    = 'Stock2Shop\\Share\\DTO\\' . str_replace('.json', '', $parts[0]);
                $contents = file_get_contents(__DIR__ . '/mocks/' . $file);
                yield $file => [
                    $class,
                    $contents
                ];
            }
        }
    }

    /**
     * Our convention is all arrays and object properties are not nullable
     *
     * @dataProvider propertiesProvider
     * @param class-string<DTO\DTOInterface> $class
     * @return void
     * @throws ReflectionException
     */
    public function testProperties(string $class): void
    {
        $ref = new ReflectionClass($class);
        foreach ($ref->getInterfaces() as $interface) {
            $this->assertContains($interface->getShortName(), ['JsonSerializable', 'DTOInterface']);
        }
        foreach ($ref->getProperties() as $property) {
            /** @psalm-suppress UndefinedMethod */
            $type = $property->getType()->getName();
            $msg = 'in ' . $class . ' property ' . $property->getName() . ' with type ' . $type ;
            if(
                str_contains($type, 'DTO') ||
                $type === 'array' ||
                $type === 'Stock2Shop\Share\Map'
            ) {
                $this->assertFalse($property->getType()->allowsNull(), $msg . ' Cannot be nullable');
            } else {
                $this->assertTrue($property->getType()->allowsNull(), $msg . ' Must be nullable');
            }
        }
    }

    private function propertiesProvider(): \Generator
    {
        foreach (scandir(__DIR__ . '/../src/DTO') as $file) {
            if (
                !in_array($file, ['DTO.php', 'DTOInterface.php', 'Maps']) &&
                $file !== '.' &&
                $file !== '..'
            ) {
                $class = 'Stock2Shop\\Share\\DTO\\' . str_replace('.php', '', $file);
                yield $class => [$class];
            }
        }
    }
}
