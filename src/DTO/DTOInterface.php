<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

interface DTOInterface {

    static function createFromJSON(string $json): DTO;
    static function createArray(array $data): array;

}
