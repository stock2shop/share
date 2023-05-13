<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

use Stock2Shop\Share\Map;

interface DTOInterface
{
    public static function createFromJSON(string $json): DTO;

    public static function createArray(array $data): array|Map;

    public function toArray(): array;
}
