<?php

namespace Stock2Shop\DTO;

class SystemVariant extends Variant
{
    /** @var int|null $id */
    public $id;

    /** @var int|null $product_id */
    public $product_id;

    /**
     * SystemVariant constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->id         = static::intFrom($data, 'id');
        $this->product_id = static::intFrom($data, 'product_id');
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
