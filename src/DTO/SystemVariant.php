<?php

namespace Stock2Shop\Share\DTO;

class SystemVariant extends Variant
{
    /** @var int|null $client_id */
    public $client_id;

    /** @var string|null $hash */
    public $hash;

    /** @var int|null $id */
    public $id;

    /** @var int|null $image_id */
    public $image_id;

    /** @var int|null $product_id */
    public $product_id;

    /** @var string|null $source_variant_code */
    public $source_variant_code;

    /**
     * SystemVariant constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->client_id           = static::intFrom($data, 'client_id');
        $this->hash                = static::stringFrom($data, 'hash');
        $this->id                  = static::intFrom($data, 'id');
        $this->image_id            = static::intFrom($data, 'image_id');
        $this->product_id          = static::intFrom($data, 'product_id');
        $this->source_variant_code = static::stringFrom($data, 'source_variant_code');
    }

    /**
     * Computes a hash of the SystemVariant
     * @return string
     */
    public function computeHash(): string
    {
        // Unlike SystemProduct there are no additional properties to include
        return parent::computeHash();
    }

    /**
     * Creates an array of this class.
     * @param array $data
     * @return SystemVariant[]
     */
    static function createArray(array $data): array
    {
        $returnable = [];

        foreach ($data as $item) {
            $returnable[] = new SystemVariant((array)$item);
        }

        return $returnable;
    }
}
