<?php
declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

class Variant extends DTO
{
    protected ?string   $source_variant_code;
    protected ?string   $sku;
    protected ?bool     $active;
    /**
     * See issue https://github.com/stock2shop/app/issues/1490
     * Currently our ddb stores qty as unsigned int, meaning positive number only
     * Once we allow negatives the check below should be changed
     */
    protected ?int      $qty;
    /** @var QtyAvailability[] $qty_availability */
    protected array     $qty_availability;
    protected ?float    $price;
    /** @var PriceTier[] $price_tiers */
    protected array     $price_tiers;
    protected ?string   $barcode;
    protected ?bool     $inventory_management;
    protected ?int      $grams;
    protected ?string   $option1;
    protected ?string   $option2;
    protected ?string   $option3;
    /** @var Meta[] $meta */
    protected array     $meta;

    function __construct(array $data)
    {
        $this->source_variant_code  = self::stringFrom($data, "source_variant_code");
        $this->sku                  = self::stringFrom($data, "sku");
        $this->active               = self::boolFrom($data, "active");
        $this->qty                  = self::intFrom($data, "qty");
        $this->qty_availability     = QtyAvailability::createArray(self::arrayFrom($data, "qty_availability"));
        $this->price                = self::floatFrom($data, "price");
        $this->price_tiers          = PriceTier::createArray(self::arrayFrom($data, "price_tiers"));
        $this->barcode              = self::stringFrom($data, "barcode");
        $this->inventory_management = self::boolFrom($data, "inventory_management");
        $this->grams                = self::intFrom($data, "grams");
        $this->option1              = self::stringFrom($data, "option1");
        $this->option2              = self::stringFrom($data, "option2");
        $this->option3              = self::stringFrom($data, "option3");
        $this->meta                 = Meta::createArray(self::arrayFrom($data, "meta"));

        // Remove once we allow negative values in DB.
        if ($this->qty < 0) {
            $this->qty = 0;
        }
    }

    public function setSourceVariantCode($arg): void
    {
        $this->source_variant_code = self::toString($arg);
    }

    public function setSKU($arg): void
    {
        $this->sku = self::toString($arg);
    }

    public function setActive($arg): void
    {
        $this->active = self::toBool($arg);
    }

    public function setQty($arg): void
    {
        $this->qty = self::toInt($arg);
    }

    public function setQtyAvailability($arg): void
    {
        $this->qty_availability = QtyAvailability::createArray($arg);
    }

    public function setPrice($arg): void
    {
        $this->price = self::toFloat($arg);
    }

    public function setPriceTiers($arg): void
    {
        $this->price_tiers = PriceTier::createArray($arg);
    }

    public function setBarcode($arg): void
    {
        $this->barcode = self::toString($arg);
    }

    public function setInventoryManagement($arg): void
    {
        $this->inventory_management = self::toBool($arg);
    }

    public function setGrams($arg): void
    {
        $this->grams = self::toInt($arg);
    }

    public function setOption1($arg): void
    {
        $this->option1 = self::toString($arg);
    }

    public function setOption2($arg): void
    {
        $this->option2 = self::toString($arg);
    }

    public function setOption3($arg): void
    {
        $this->option3 = self::toString($arg);
    }

    public function setMeta($arg): void
    {
        $this->meta = Meta::createArray($arg);
    }

    public function getSourceVariantCode(): ?string
    {
        return $this->source_variant_code;
    }

    public function getSKU(): ?string
    {
        return $this->sku;
    }

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function getQty(): ?int
    {
        return $this->qty;
    }

    /** @return QtyAvailability[] */
    public function getQtyAvailability(): array
    {
        return $this->qty_availability;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    /** @return PriceTier[] */
    public function getPriceTiers(): array
    {
        return $this->price_tiers;
    }

    public function getBarcode(): ?string
    {
        return $this->barcode;
    }

    public function getInventoryManagement(): ?bool
    {
        return $this->inventory_management;
    }

    public function getGrams(): ?int
    {
        return $this->grams;
    }

    public function getOption1(): ?string
    {
        return $this->option1;
    }

    public function getOption2(): ?string
    {
        return $this->option2;
    }

    public function getOption3(): ?string
    {
        return $this->option3;
    }

    /** @return Meta[] */
    public function getMeta(): array
    {
        return $this->meta;
    }

    /**
     * sort array properties of Variant
     */
    public function sort()
    {
        $this->sortArray($this->qty_availability, "description");
        $this->sortArray($this->price_tiers, "tier");
        $this->sortArray($this->meta, "key");
    }

    /**
     * computeHash of the Variant
     */
    public function computeHash(): string
    {
        $v = new Variant((array)$this);
        $v->sort();
        $json = json_encode($v);
        return md5($json);
    }
}
