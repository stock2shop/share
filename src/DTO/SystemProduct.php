<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

class SystemProduct extends Product
{
    /** @var Channel[] $channels */
    public readonly array $channels;
    public readonly ?int $client_id;
    public readonly ?string $created;
    public readonly ?string $hash;
    public readonly ?int $id;
    /** @var SystemImage[] $images */
    public array $images;
    public readonly ?string $modified;
    public readonly ?int $source_id;
    public readonly ?string $source_product_code;
    /** @var SystemVariant[] $variants */
    public array $variants;

    public function __construct(array $data)
    {
        parent::__construct($data);

        $images   = SystemImage::createArray(self::arrayFrom($data, 'images'));
        $variants = SystemVariant::createArray(self::arrayFrom($data, 'variants'));
        $channels = Channel::createArray(self::arrayFrom($data, 'channels'));

        $this->channels            = $this->sortArray($channels, 'id');
        $this->client_id           = self::intFrom($data, 'client_id');
        $this->created             = self::stringFrom($data, 'created');
        $this->hash                = self::stringFrom($data, 'hash');
        $this->id                  = self::intFrom($data, 'id');
        $this->images              = $this->sortArray($images, 'id');
        $this->modified            = self::stringFrom($data, 'modified');
        $this->source_id           = self::intFrom($data, 'source_id');
        $this->source_product_code = self::stringFrom($data, 'source_product_code');
        $this->variants            = $this->sortArray($variants, 'id');
    }

    public function computeHash(): string
    {
        $productHash = parent::computeHash();
        $productHash .= sprintf("\nsource_product_code=%s", $this->source_product_code);
        foreach ($this->images as $i) {
            $productHash .= sprintf("\nimage_%d=%s", $i->id, $i->src);
        }
        return md5($productHash);
    }
}
