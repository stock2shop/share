<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

use JsonSerializable;

/**
 * @psalm-import-type TypeMeta from Meta
 * @psalm-import-type TypeQtyAvailability from QtyAvailability
 * @psalm-type TypeChannelVariant = array{
 *     channel_id?: int,
 *     channel_variant_code?: string,
 *     client_id?: int,
 *     delete?: bool,
 *     hash?: string,
 *     id?: int,
 *     image_id?: int,
 *     product_id?: int,
 *     success?: bool,
 *     source_variant_code?: string,
 *     sku?: string,
 *     active?: bool,
 *     qty?: int,
 *     qty_availability: TypeQtyAvailability,
 *     price?: float,
 *     price_tiers: PriceTier,
 *     barcode?: string,
 *     inventory_management?: bool,
 *     grams?: int,
 *     option1?: string,
 *     option2?: string,
 *     option3?: string,
 *     meta: TypeMeta
 * }
 */
class ChannelVariant extends Variant implements JsonSerializable, DTOInterface
{
    public ?int $channel_id;
    public ?string $channel_variant_code;
    public ?int $client_id;
    public ?bool $delete;
    public ?string $hash;
    public ?int $id;
    public ?int $image_id;
    public ?int $product_id;
    public ?bool $success;

    /**
     * @param TypeChannelVariant $data
     */
    public function __construct(array $data)
    {
        /** @psalm-suppress InvalidArgument */
        parent::__construct($data);

        $this->channel_id           = self::intFrom($data, 'channel_id');
        $this->channel_variant_code = self::stringFrom($data, 'channel_variant_code');
        $this->client_id            = static::intFrom($data, 'client_id');
        $this->delete               = self::boolFrom($data, 'delete');
        $this->hash                 = static::stringFrom($data, 'hash');
        $this->id                   = static::intFrom($data, 'id');
        $this->image_id             = static::intFrom($data, 'image_id');
        $this->product_id           = static::intFrom($data, 'product_id');
        $this->success              = self::boolFrom($data, 'success');
    }

    public static function createFromJSON(string $json): ChannelVariant
    {
        $data = json_decode($json, true);
        return new ChannelVariant($data);
    }

    public function jsonSerialize(): array
    {
        return (array)$this;
    }

    /**
     * @return ChannelVariant[]
     */
    public static function createArray(array $data): array
    {
        $a = [];
        foreach ($data as $item) {
            $a[] = new ChannelVariant((array)$item);
        }
        return $a;
    }
}
