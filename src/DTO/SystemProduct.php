<?php
declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

class SystemProduct extends Product
{
    /** @var Channel[] $channels */
    public array     $channels;
    public ?int      $client_id;
    public ?string   $created;
    public ?string   $hash;
    public ?int      $id;
    /** @var SystemImage[] $images */
    public array     $images;
    public ?string   $modified;
    public ?int      $source_id;
    public ?string   $source_product_code;
    /** @var SystemVariant[] $variants */
    public array     $variants;

    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->channels            = Channel::createArray(self::arrayFrom($data, 'channels'));
        $this->client_id           = self::intFrom($data, 'client_id');
        $this->created             = self::stringFrom($data, 'created');
        $this->hash                = self::stringFrom($data, 'hash');
        $this->id                  = self::intFrom($data, 'id');
        $this->images              = SystemImage::createArray(self::arrayFrom($data, 'images'));
        $this->modified            = self::stringFrom($data, 'modified');
        $this->source_id           = self::intFrom($data, 'source_id');
        $this->source_product_code = self::stringFrom($data, 'source_product_code');
        $this->variants            = SystemVariant::createArray(self::arrayFrom($data, 'variants'));
    }

    public function sort()
    {
        $this->sortArray($this->images, "id");
    }

    public function computeHash(): string
    {
        $productHash = parent::computeHash();
        $this->sort();
        $productHash .= "\nsource_product_code=$this->source_product_code";
        foreach ($this->images as $i) {
            $id          = $i->getID();
            $productHash .= "\nimage_$id=" . $i->getSrc();
        }
        return md5($productHash);
    }
}
