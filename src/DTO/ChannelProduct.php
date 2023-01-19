<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

use JsonSerializable;

class ChannelProduct extends Product implements JsonSerializable, DTOInterface
{
    public ?int $channel_id;
    public ?string $channel_product_code;
    public ?int $client_id;
    public ?string $created;
    public ?bool $delete;
    public ?string $hash;
    public ?int $id;
    /** @var ChannelImage[] $images */
    public array $images;
    public ?string $modified;
    public ?int $source_id;
    public ?string $source_product_code;
    public ?bool $success;
    public ?string $synced;
    /** @var ChannelVariant[] $variants */
    public array $variants;

    public function __construct(array $data)
    {
        parent::__construct($data);

        $images   = ChannelImage::createArray(self::arrayFrom($data, 'images'));
        $variants = ChannelVariant::createArray(self::arrayFrom($data, 'variants'));

        $this->channel_id           = self::intFrom($data, 'channel_id');
        $this->channel_product_code = self::stringFrom($data, 'channel_product_code');
        $this->client_id            = self::intFrom($data, 'client_id');
        $this->created              = self::stringFrom($data, 'created');
        $this->delete               = self::boolFrom($data, 'delete');
        $this->hash                 = self::stringFrom($data, 'hash');
        $this->id                   = self::intFrom($data, 'id');
        $this->images               = $this->sortArray($images, 'id');
        $this->modified             = self::stringFrom($data, 'modified');
        $this->source_id            = self::intFrom($data, 'source_id');
        $this->source_product_code  = self::stringFrom($data, 'source_product_code');
        $this->success              = self::boolFrom($data, 'success');
        $this->synced               = self::stringFrom($data, 'synced');
        $this->variants             = $this->sortArray($variants, 'id');
    }

    public static function createFromJSON(string $json): ChannelProduct
    {
        $data = json_decode($json, true);
        return new ChannelProduct($data);
    }

    public function jsonSerialize(): array
    {
        return (array)$this;
    }

    /**
     * Computes a hash of the ChannelProduct
     */
    public function computeHash(): string
    {
        $productHash = parent::computeHash();
        $productHash .= sprintf("\nsource_product_code=%s", $this->source_product_code);
        $productHash .= sprintf("\nchannel_product_code=%s", $this->channel_product_code);
        foreach ($this->images as $i) {
            $productHash .= sprintf("\nimage_%d=%s", $i->id, $i->src);
        }
        foreach ($this->variants as $v) {
            $productHash .= sprintf("\nvariant_%d=%s", $v->id, $v->computeHash());
        }
        print_r(md5($productHash));
        return md5($productHash);
    }

    /**
     * @return ChannelProduct[]
     */
    public static function createArray(array $data): array
    {
        $a = [];
        foreach ($data as $item) {
            $a[] = new ChannelProduct((array)$item);
        }
        return $a;
    }
}
