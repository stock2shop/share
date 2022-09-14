<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

class Variant extends DTO
{
    public readonly ?string $source_variant_code;
    public readonly ?string $sku;
    public readonly ?bool $active;
    /**
     * See issue https://github.com/stock2shop/app/issues/1490
     * Currently our ddb stores qty as unsigned int, meaning positive number only
     * Once we allow negatives the check below should be changed
     */
    public readonly ?int $qty;
    /** @var QtyAvailability[] $qty_availability */
    public readonly array $qty_availability;
    public readonly ?float $price;
    /** @var PriceTier[] $price_tiers */
    public readonly array $price_tiers;
    public readonly ?string $barcode;
    public readonly ?bool $inventory_management;
    public readonly ?int $grams;
    public readonly ?string $option1;
    public readonly ?string $option2;
    public readonly ?string $option3;
    /** @var Meta[] $meta */
    public readonly array $meta;

    function __construct(array $data)
    {
        $qty              = self::intFrom($data, "qty");
        $qty_availability = QtyAvailability::createArray(self::arrayFrom($data, "qty_availability"));
        $price_tiers      = PriceTier::createArray(self::arrayFrom($data, "price_tiers"));
        $meta             = Meta::createArray(self::arrayFrom($data, "meta"));

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
        $this->meta                 = $this->sortArray($meta, "key");
    }

    /**
     * computeHash of the Variant
     */
    public function computeHash(): string
    {
        $v    = new Variant((array)$this);
        $json = json_encode($v);
        return md5($json);
    }
}
