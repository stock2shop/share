<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

interface DTOInterface
{
    public static function createFromJSON(string $json): DTO;

    public static function createArray(array $data): array;

    public function toArray(): array;
}
