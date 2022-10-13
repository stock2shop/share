<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

use JsonSerializable;

class ChannelProduct extends SystemProduct implements JsonSerializable, DTOInterface
{
    public ChannelProductChannel $channel;
    /** @var ChannelImage[] $images */
    public array $images;
    /** @var ChannelVariant[] $variants */
    public array $variants;

    public function __construct(array $data)
    {
        parent::__construct($data);

        $images         = ChannelImage::createArray(self::arrayFrom($data, 'images'));
        $variants       = ChannelVariant::createArray(self::arrayFrom($data, 'variants'));

        $this->channel  = new ChannelProductChannel(self::arrayFrom($data, 'channel'));
        $this->images   = $this->sortArray($images, "id");
        $this->variants = $this->sortArray($variants, "id");
    }

    static function createFromJSON(string $json): ChannelProduct
    {
        $data = json_decode($json, true);
        return new ChannelProduct($data);
    }

    public function jsonSerialize(): array
    {
        return (array) $this;
    }

    /**
     * Computes a hash of the ChannelProduct
     */
    public function computeHash(): string
    {
        $productHash = parent::computeHash();
        $productHash .= sprintf('\nchannel_product_code=%s', $this->channel->channel_product_code);
        foreach ($this->variants as $v) {
            $productHash .= sprintf('\nvariant_%d=%s', $v->id, $v->computeHash());
        }
        return md5($productHash);
    }

    /**
     * Creates an array of class instances, instantiated with data.
     * @return ChannelProduct[]
     */
    static function createArray(array $data): array
    {
        $a = [];
        foreach ($data as $item) {
            $a[] = new ChannelProduct((array) $item);
        }
        return $a;
    }

}
