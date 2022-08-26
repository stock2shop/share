<?php

namespace Stock2Shop\Share\DTO;

class ChannelVariant extends SystemVariant
{
    /** @var string|null $channel_variant_code */
    protected $channel_variant_code;

    /** @var bool|null $delete */
    protected $delete;

    /** @var bool|null $success */
    protected $success;

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->channel_variant_code = self::stringFrom($data, 'channel_variant_code');
        $this->delete               = self::boolFrom($data, 'delete');
        $this->success              = self::boolFrom($data, 'success');
    }

    public function setChannelVariantCode($arg)
    {
        $this->channel_variant_code = self::toString($arg);
    }

    public function setDelete($arg)
    {
        $this->delete = self::toBool($arg);
    }

    public function setSuccess($arg)
    {
        $this->success = self::toBool($arg);
    }

    /**
     * Returns true if the variant is considered synced with a channel.
     *
     * @return bool
     */
    public function hasSyncedToChannel(): bool
    {
        return (
            $this->success &&
            is_string($this->channel_variant_code) &&
            $this->channel_variant_code !== ''
        );
    }

    /**
     * Computes a hash of the ChannelVariant
     * @return string
     */
    public function computeHash(): string
    {
        $variantHash = parent::computeHash();
        $variantHash .= "\nchannel_variant_code=$this->channel_variant_code";
        return md5($variantHash);
    }

}
