<?php

namespace Stock2Shop\DTO;

class SystemProduct extends Product
{
    /** @var int|null $id */
    public $id;

    /** @var string|null $source_product_code */
    public $source_product_code;

    /** @var SystemVariant[] $variants */
    public $variants;

    /** @var SystemImage[] $images */
    public $images;

    /**
     * SystemProduct constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->id                  = static::intFrom($data, 'id');
        $this->source_product_code = static::stringFrom($data, 'source_product_code');
        $this->variants            = SystemVariant::createArray(static::arrayFrom($data, 'variants'));
        $this->images              = SystemImage::createArray(static::arrayFrom($data, 'images'));
    }

    /**
     * sort array properties of Product
     */
    public function sort()
    {
        $this->sortArray($this->images, "id");
    }

    /**
     * @return string
     */
    public function computeHash(): string
    {
        $productHash = parent::computeHash();
        // More properties to include in the hash?
        // Order is important.
        // DO NOT include Stock2Shop DB IDs,
        // auto-increment PK might be replaced by KSUID
        $this->sort();
        $productHash .= "\nsource_product_code=$this->source_product_code";
        foreach ($this->images as $i) {
            $productHash .= "\nimage_$i->id=" . $i->src;
        }
        return md5($productHash);
    }
}
