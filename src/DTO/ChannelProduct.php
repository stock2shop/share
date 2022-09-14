<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

class ChannelProduct extends SystemProduct
{
    public readonly ChannelProductChannel $channel;
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

}
