<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

use JsonSerializable;

class SystemVariant extends Variant implements JsonSerializable, DTOInterface
{
    public ?int $client_id;
    public ?string $hash;
    public ?int $id;
    public ?int $image_id;
    public ?int $product_id;

    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->client_id  = static::intFrom($data, 'client_id');
        $this->hash       = static::stringFrom($data, 'hash');
        $this->id         = static::intFrom($data, 'id');
        $this->image_id   = static::intFrom($data, 'image_id');
        $this->product_id = static::intFrom($data, 'product_id');
    }

    static function createFromJSON(string $json): SystemVariant
    {
        $data = json_decode($json, true);
        return new SystemVariant($data);
    }

    public function jsonSerialize(): array
    {
        return (array) $this;
    }

    /**
     * @return SystemVariant[]
     */
    static function createArray(array $data): array
    {
        $a = [];
        foreach ($data as $item) {
            $a[] = new SystemVariant((array) $item);
        }
        return $a;
    }

}
