<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

class ChannelProduct extends Product
{
    public readonly ?int $client_id;
    public readonly ?string $created;
    public readonly ?string $hash;
    public readonly ?int $id;
    /** @var ChannelImage[] $images */
    public readonly array $images;
    public readonly ?string $modified;
    public readonly ?int $source_id;
    public readonly ?string $source_product_code;
    /** @var ChannelVariant[] $variants */
    public readonly array $variants;
    public readonly ChannelProductChannel $channel;

    public function __construct(array $data)
    {
        parent::__construct($data);

        $images   = ChannelImage::createArray(self::arrayFrom($data, 'images'));
        $variants = ChannelVariant::createArray(self::arrayFrom($data, 'variants'));

        $this->channel             = new ChannelProductChannel(self::arrayFrom($data, 'channel'));
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

    /**
     * Computes a hash of the ChannelProduct
     */
    public function computeHash(): string
    {
        $productHash = parent::computeHash();
        $productHash .= sprintf("\nsource_product_code=%s", $this->source_product_code);
        $productHash .= sprintf("\nchannel_product_code=%s", $this->channel->channel_product_code);
        foreach ($this->images as $i) {
            $productHash .= sprintf("\nimage_%d=%s", $i->id, $i->src);
        }
        foreach ($this->variants as $v) {
            $productHash .= sprintf("\nvariant_%d=%s", $v->id, $v->computeHash());
        }
        return md5($productHash);
    }

}
