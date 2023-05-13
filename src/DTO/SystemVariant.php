<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

/**
 * @psalm-import-type TypeQtyAvailability from QtyAvailability
 * @psalm-import-type TypeMeta from Meta
 * @psalm-import-type TypePriceTier from PriceTier
 * @psalm-type TypeSystemVariant = array{
 *     active?: bool|null,
 *     barcode?: string|null,
 *     client_id?: int|null,
 *     created?: string|null,
 *     grams?: int|null,
 *     hash?: string|null,
 *     id?: int|null,
 *     image_id?: int|null,
 *     inventory_management?: bool|null,
 *     meta?: array<int, TypeMeta>|array<int, Meta>,
 *     option1?: string|null,
 *     option2?: string|null,
 *     option3?: string|null,
 *     modified?: string|null,
 *     price?: float|null,
 *     price_tiers?: array<int, TypePriceTier>|array<int, PriceTier>,
 *     product_id?: int|null,
 *     qty?: int|null,
 *     qty_availability?: array<int, TypeQtyAvailability>|array<int, QtyAvailability>,
 *     sku?: string|null,
 *     source_variant_code?: string|null
 * }
 */
class SystemVariant extends Variant
{
    public ?int $client_id;
    public ?string $created;
    public ?string $hash;
    public ?int $id;
    public ?int $image_id;
    public ?string $modified;
    public ?int $product_id;

    /**
     * @param TypeSystemVariant $data
     */
    public function __construct(array $data)
    {
        /** @psalm-suppress InvalidArgument */
        parent::__construct($data);

        $this->client_id  = static::intFrom($data, 'client_id');
        $this->created    = self::stringFrom($data, 'created');
        $this->hash       = static::stringFrom($data, 'hash');
        $this->id         = static::intFrom($data, 'id');
        $this->image_id   = static::intFrom($data, 'image_id');
        $this->modified   = self::stringFrom($data, 'modified');
        $this->product_id = static::intFrom($data, 'product_id');
    }
}
