<?php
declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

class ChannelProduct extends SystemProduct
{
    public ChannelProductChannel $channel;
    /** @var ChannelImage[] $images */
    public array $images;
    /** @var ChannelVariant[] $variants */
    public array $variants;


    public function __construct(array $data)
    {
        parent::__construct($data);
        $this->channel  = new ChannelProductChannel(self::arrayFrom($data, 'channel'));
        $this->images   = ChannelImage::createArray(self::arrayFrom($data, 'images'));
        $this->variants = ChannelVariant::createArray(self::arrayFrom($data, 'variants'));
    }

    /**
     * sort array properties of ChannelProduct
     */
    public function sort()
    {
        $this->sortArray($this->images, "id");
        $this->sortArray($this->variants, "id");
    }

    /**
     * Computes a hash of the ChannelProduct
     */
    public function computeHash(): string
    {
        $productHash = parent::computeHash();
        $this->sort();
        $cpc = $this->channel->getChannelProductCode();
        $productHash .= "\nchannel_product_code=$cpc";

        // TODO check this!
        foreach ($this->images as $i) {
            $id          = $i->getID();
            $productHash .= "\nimage_$id=" . $i->getSrc();
        }
        foreach ($this->variants as $v) {
            $id          = $v->getID();
            $productHash .= "\nvariant_$id=" . $v->computeHash();
        }
        return md5($productHash);
    }

}
