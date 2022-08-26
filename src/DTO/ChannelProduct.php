<?php

namespace Stock2Shop\Share\DTO;

class ChannelProduct extends SystemProduct
{

    /** @var int|null $channel_id */
    protected $channel_id;

    /** @var string $channel_product_code */
    protected $channel_product_code;

    /** @var bool|null $delete */
    protected $delete;

    /** @var ChannelVariant[] $variants */
    protected $variants;

    /** @var bool|null $success */
    protected $success;

    /** @var string|null $synced */
    protected $synced;

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        parent::__construct($data);
        $this->channel_id           = self::intFrom($data, 'channel_id');
        $this->channel_product_code = self::stringFrom($data, 'channel_product_code');
        $this->delete               = self::boolFrom($data, 'delete');
        $this->variants             = ChannelVariant::createArray(self::arrayFrom($data, 'variants'));
        $this->success              = self::boolFrom($data, 'success');
        $this->synced               = self::stringFrom($data, 'synced');
    }

    public function setChannelID($arg)
    {
        $this->channel_id = self::toInt($arg);
    }

    public function setChannelProductCode($arg)
    {
        $this->channel_product_code = self::toString($arg);
    }

    public function setDelete($arg)
    {
        $this->delete = self::toBool($arg);
    }

    public function setVariants($arg)
    {
        $this->variants = ChannelVariant::createArray($arg);
    }

    public function setSuccess($arg)
    {
        $this->success = self::toBool($arg);
    }

    public function setSynced($arg)
    {
        $this->synced = self::toString($arg);
    }

    /**
     * Returns true if a product is considered synced with a channel.
     *
     * @return bool
     */
    public function hasSyncedToChannel(): bool
    {
        return (
            $this->success &&
            is_string($this->channel_product_code) &&
            $this->channel_product_code !== ''
        );
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
        $productHash .= "\nchannel_product_code=$this->channel_product_code";

        // TODO check this!
        foreach ($this->images as $i) {
            $productHash .= "\nimage_$i->id=" . $i->src;
        }
        foreach ($this->variants as $v) {
            $productHash .= "\nvariant_$v->id=" . $v->computeHash();
        }
        return md5($productHash);
    }

}
