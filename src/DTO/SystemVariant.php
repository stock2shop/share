<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

class SystemVariant extends Variant
{
    public readonly ?int $client_id;
    public readonly ?string $hash;
    public readonly ?int $id;
    public readonly ?int $image_id;
    public readonly ?int $product_id;

    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->client_id  = static::intFrom($data, 'client_id');
        $this->hash       = static::stringFrom($data, 'hash');
        $this->id         = static::intFrom($data, 'id');
        $this->image_id   = static::intFrom($data, 'image_id');
        $this->product_id = static::intFrom($data, 'product_id');
    }

}
