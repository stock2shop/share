<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

use Stock2Shop\Share\DTO\Maps\Metas;

/**
 * @psalm-import-type TypeMeta from Meta
 * @psalm-import-type TypeQtyAvailability from QtyAvailability
 * @psalm-import-type TypePriceTier from PriceTier
 * @psalm-type TypeVariant = array{
 *     active?: bool|null,
 *     barcode?: string|null,
 *     grams?: int|null,
 *     inventory_management?: bool|null,
 *     meta?: array<int, TypeMeta>|array<int, Meta>,
 *     option1?: string|null,
 *     option2?: string|null,
 *     option3?: string|null,
 *     price?: float|null,
 *     price_tiers?: array<int, TypePriceTier>|array<int, PriceTier>,
 *     qty?: int|null,
 *     qty_availability?: array<int, TypeQtyAvailability>|array<int, QtyAvailability>,
 *     sku?: string|null,
 *     source_variant_code?: string|null,
 * }
 */
class Variant extends DTO
{
    public ?string $source_variant_code;
    public ?string $sku;
    public ?bool $active;
    /**
     * See issue https://github.com/stock2shop/app/issues/1490
     * Currently our db stores qty as unsigned int, meaning positive number only
     * Once we allow negatives the check below should be changed
     */
    public ?int $qty;
    /** @var QtyAvailability[] $qty_availability */
    public array $qty_availability;
    public ?float $price;
    /** @var PriceTier[] $price_tiers */
    public array $price_tiers;
    public ?string $barcode;
    public ?bool $inventory_management;
    public ?int $grams;
    public ?string $option1;
    public ?string $option2;
    public ?string $option3;
    /** @var Metas $meta */
    public Metas $meta;

    /**
     * @param TypeVariant $data
     */
    public function __construct(array $data)
    {
        $qty              = self::intFrom($data, "qty");
        $qty_availability = QtyAvailability::createArray(self::arrayFrom($data, "qty_availability"));
        $price_tiers      = PriceTier::createArray(self::arrayFrom($data, "price_tiers"));

        $this->source_variant_code  = self::stringFrom($data, "source_variant_code");
        $this->sku                  = self::stringFrom($data, "sku");
        $this->active               = self::boolFrom($data, "active");
        $this->qty                  = ($qty < 0) ? 0 : $qty;
        $this->qty_availability     = $this->sortArray($qty_availability, "description");
        $this->price                = self::floatFrom($data, "price");
        $this->price_tiers          = $this->sortArray($price_tiers, "tier");
        $this->barcode              = self::stringFrom($data, "barcode");
        $this->inventory_management = self::boolFrom($data, "inventory_management");
        $this->grams                = self::intFrom($data, "grams");
        $this->option1              = self::stringFrom($data, "option1");
        $this->option2              = self::stringFrom($data, "option2");
        $this->option3              = self::stringFrom($data, "option3");
        $this->meta                 = new Metas(self::arrayFrom($data, "meta"));
    }

    /**
     * computeHash of the Variant
     */
    public function computeHash(): string
    {
        $v    = new Variant($this->toArray());
        $json = json_encode($v);
        return md5($json);
    }

    public static function createFromJSON(string $json): Variant
    {
        $data = json_decode($json, true);
        return new Variant($data);
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    public function toArray(): array {
        $meta = $this->meta->toArray();
        $arr = (array)$this;
        $arr['meta'] = $meta;
        return $arr;
    }

    /**
     * @return Variant[]
     */
    public static function createArray(array $data): array
    {
        $a = [];
        foreach ($data as $item) {
            $a[] = new Variant((array)$item);
        }
        return $a;
    }
}
