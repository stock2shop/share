<?php
declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

class ChannelVariantChannel extends DTO
{
    public ?int      $channel_id;
    public ?string   $channel_variant_code;
    public ?bool     $delete;
    public ?bool     $success;

    public function __construct(array $data)
    {
        $this->channel_id           = self::intFrom($data, 'channel_id');
        $this->channel_variant_code = self::stringFrom($data, 'channel_variant_code');
        $this->delete               = self::boolFrom($data, 'delete');
        $this->success              = self::boolFrom($data, 'success');
    }
}
