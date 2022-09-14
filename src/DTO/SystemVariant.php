<?php
declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

class SystemVariant extends Variant
{
    public ?int      $client_id;
    public ?string   $hash;
    public ?int      $id;
    public ?int      $image_id;
    public ?int      $product_id;

    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->client_id  = static::intFrom($data, 'client_id');
        $this->hash       = static::stringFrom($data, 'hash');
        $this->id         = static::intFrom($data, 'id');
        $this->image_id   = static::intFrom($data, 'image_id');
        $this->product_id = static::intFrom($data, 'product_id');
    }

    /**
     * Computes a hash of the SystemVariant
     */
    public function computeHash(): string
    {
        return parent::computeHash();
    }
}
