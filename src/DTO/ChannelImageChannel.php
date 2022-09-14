<?php
declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

class ChannelImageChannel extends DTO
{
    public ?int      $channel_id;
    public ?string   $channel_image_code;
    public ?bool     $delete;
    public ?bool     $success;

    public function __construct(array $data)
    {
        $this->channel_id         = self::intFrom($data, 'channel_id');
        $this->channel_image_code = self::stringFrom($data, 'channel_image_code');
        $this->delete             = self::boolFrom($data, 'delete');
        $this->success            = self::boolFrom($data, 'success');
    }
}
