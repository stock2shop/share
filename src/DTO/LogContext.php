<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

use JsonSerializable;

class LogContext extends DTO implements JsonSerializable, DTOInterface
{
    public ?string $key;
    public ?string $value;

    public function __construct(array $data)
    {
        $this->key           = self::stringFrom($data, "key");
        $this->value         = self::stringFrom($data, "value");
    }

    public static function createFromJSON(string $json): LogContext
    {
        $data = json_decode($json, true);
        return new LogContext($data);
    }

    public function jsonSerialize(): array
    {
        return (array)$this;
    }

    /**
     * @return LogContext[]
     */
    public static function createArray(array $data): array
    {
        $a = [];
        foreach ($data as $item) {
            $a[] = new LogContext((array)$item);
        }
        return $a;
    }
}
