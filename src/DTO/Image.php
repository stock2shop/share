<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

use JsonSerializable;

class Image extends DTO implements JsonSerializable, DTOInterface
{
    public ?string $src;

    public function __construct(array $data)
    {
        $this->src = self::stringFrom($data, 'src');
    }

    static function createFromJSON(string $json): Image
    {
        $data = json_decode($json, true);
        return new Image($data);
    }

    public function jsonSerialize(): array
    {
        return (array) $this;
    }
}
