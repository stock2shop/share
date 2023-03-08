<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

use JsonSerializable;

/**
 * @psalm-import-type TypeQtyAvailability from QtyAvailability
 * @psalm-import-type TypeMeta from Meta
 * @psalm-import-type TypePriceTier from PriceTier
 * @psalm-type TypeSystemVariant = array{
 *     client_id?: int|null,
 *     hash?: string|null,
 *     id?: int|null,
 *     image_id?: int|null,
 *     product_id?: int|null,
 *     source_variant_code?: string|null,
 *     sku?: string|null,
 *     active?: bool|null,
 *     qty?: int|null,
 *     qty_availability: TypeQtyAvailability,
 *     price?: float|null,
 *     price_tiers: TypePriceTier,
 *     barcode?: string|null,
 *     inventory_management?: bool|null,
 *     grams?: int|null,
 *     option1?: string|null,
 *     option2?: string|null,
 *     option3?: string|null,
 *     meta: TypeMeta
 * }
 */
class SystemVariant extends Variant implements JsonSerializable, DTOInterface
{
    public ?int $client_id;
    public ?string $hash;
    public ?int $id;
    public ?int $image_id;
    public ?int $product_id;

    /**
     * @param TypeSystemVariant $data
     */
    public function __construct(array $data)
    {
        /** @psalm-suppress InvalidArgument */
        parent::__construct($data);

        $this->client_id  = static::intFrom($data, 'client_id');
        $this->hash       = static::stringFrom($data, 'hash');
        $this->id         = static::intFrom($data, 'id');
        $this->image_id   = static::intFrom($data, 'image_id');
        $this->product_id = static::intFrom($data, 'product_id');
    }

    public static function createFromJSON(string $json): SystemVariant
    {
        $data = json_decode($json, true);
        return new SystemVariant($data);
    }

    public function jsonSerialize(): array
    {
        return (array)$this;
    }

    /**
     * @return SystemVariant[]
     */
    public static function createArray(array $data): array
    {
        $a = [];
        foreach ($data as $item) {
            $a[] = new SystemVariant((array)$item);
        }
        return $a;
    }
}
