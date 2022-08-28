<?php

namespace Stock2Shop\Share\DTO;

class ChannelProduct extends SystemProduct
{

    /** @var ChannelProductChannel $channel */
    protected $channel;

    /** @var ChannelImage[] $images */
    protected $images;

    /** @var ChannelVariant[] $variants */
    protected $variants;

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        parent::__construct($data);
        $this->channel  = new ChannelProductChannel(self::arrayFrom($data, 'channel'));
        $this->images   = ChannelImage::createArray(self::arrayFrom($data, 'images'));
        $this->variants = ChannelVariant::createArray(self::arrayFrom($data, 'variants'));
    }

    public function setChannel($arg)
    {
        $this->channel = new ChannelProductChannel($arg);
    }

    public function setImages($arg)
    {
        $this->variants = ChannelImage::createArray($arg);
    }

    public function setVariants($arg)
    {
        $this->variants = ChannelVariant::createArray($arg);
    }

    public function getChannel()
    {
        return $this->channel;
    }

    public function getImages(): array
    {
        return $this->images;
    }

    public function getVariants(): array
    {
        return $this->variants;
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
     * @return string
     */
    public function computeHash(): string
    {
        $productHash = parent::computeHash();
        $this->sort();
        $cpc = $this->getChannel()->getChannelProductCode();
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
