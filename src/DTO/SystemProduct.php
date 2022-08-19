<?php

namespace Stock2Shop\Share\DTO;

class SystemProduct extends Product
{
    /** @var Channel[] $channels */
    public $channels;

    /** @var int|null $client_id */
    public $client_id;

    /** @var string|null $created */
    public $created;

    /** @var string|null $hash */
    public $hash;

    /** @var int|null $id */
    public $id;

    /** @var SystemImage[] $images */
    public $images;

    /** @var string|null $modified */
    public $modified;

    /** @var int|null $source_id */
    public $source_id;

    /** @var string|null $source_product_code */
    public $source_product_code;

    /** @var SystemVariant[] $variants */
    public $variants;

    /**
     * SystemProduct constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->channels            = Channel::createArray(static::arrayFrom($data, 'channels'));
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

    /**
     * @param array $data
     * @return SystemProduct[]
     */
    static function createArray(array $data): array
    {
        $a = [];
        foreach ($data as $item) {
            $cv  = new SystemProduct((array)$item);
            $a[] = $cv;
        }
        return $a;
    }
}
