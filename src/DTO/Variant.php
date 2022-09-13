<?php

namespace Stock2Shop\Share\DTO;

class Variant extends DTO
{
    /** @var string|null $source_variant_code */
    protected $source_variant_code;

    /** @var string|null $sku */
    protected $sku;

    /** @var bool|null $active */
    protected $active;

    /** @var int|null $qty
     * See issue https://github.com/stock2shop/app/issues/1490
     * Currently our ddb stores qty as unsigned int, meaning positive number only
     * Once we allow negatives the check below should be changed
     */
    protected $qty;

    /** @var QtyAvailability[] $qty_availability */
    protected $qty_availability;

    /** @var float|null $price */
    protected $price;

    /** @var PriceTier[] $price_tiers */
    protected $price_tiers;

    /** @var string|null $barcode */
    protected $barcode;

    /** @var bool|null $inventory_management */
    protected $inventory_management;

    /** @var int|null $grams */
    protected $grams;

    /** @var string|null $option1 */
    protected $option1;

    /** @var string|null $option2 */
    protected $option2;

    /** @var string|null $option3 */
    protected $option3;

    /** @var Meta[] $meta */
    protected $meta;

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

    public function setSourceVariantCode($arg)
    {
        $this->source_variant_code = self::toString($arg);
    }

    public function setSKU($arg)
    {
        $this->sku = self::toString($arg);
    }

    public function setActive($arg)
    {
        $this->active = self::toBool($arg);
    }

    public function setQty($arg)
    {
        $this->qty = self::toInt($arg);
    }

    public function setQtyAvailability($arg)
    {
        $this->qty_availability = QtyAvailability::createArray($arg);
    }

    public function setPrice($arg)
    {
        $this->price = self::toFloat($arg);
    }

    public function setPriceTiers($arg)
    {
        $this->price_tiers = PriceTier::createArray($arg);
    }

    public function setBarcode($arg)
    {
        $this->barcode = self::toString($arg);
    }

    public function setInventoryManagement($arg)
    {
        $this->inventory_management = self::toBool($arg);
    }

    public function setGrams($arg)
    {
        $this->grams = self::toInt($arg);
    }

    public function setOption1($arg)
    {
        $this->option1 = self::toString($arg);
    }

    public function setOption2($arg)
    {
        $this->option2 = self::toString($arg);
    }

    public function setOption3($arg)
    {
        $this->option3 = self::toString($arg);
    }

    public function setMeta($arg)
    {
        $this->meta = Meta::createArray($arg);
    }

    public function getSourceVariantCode()
    {
        return $this->source_variant_code;
    }

    public function getSKU()
    {
        return $this->sku;
    }

    public function getActive()
    {
        return $this->active;
    }

    public function getQty()
    {
        return $this->qty;
    }

    public function getQtyAvailability()
    {
        return $this->qty_availability;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getPriceTiers()
    {
        return $this->price_tiers;
    }

    public function getBarcode()
    {
        return $this->barcode;
    }

    public function getInventoryManagement()
    {
        return $this->inventory_management;
    }

    public function getGrams()
    {
        return $this->grams;
    }

    public function getOption1()
    {
        return $this->option1;
    }

    public function getOption2()
    {
        return $this->option2;
    }

    public function getOption3()
    {
        return $this->option3;
    }

    public function getMeta()
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
     *
     * @return string
     */
    public function computeHash(): string
    {
        $v = new Variant((array)$this);
        $v->sort();
        $json = json_encode($v);
        return md5($json);
    }
}
