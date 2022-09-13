<?php

namespace Stock2Shop\Share\DTO;

class ChannelImageChannel extends DTO
{

    protected ?int      $channel_id;
    protected ?string   $channel_image_code;
    protected ?bool     $delete;
    protected ?bool     $success;

    public function __construct(array $data)
    {
        $this->channel_id         = self::intFrom($data, 'channel_id');
        $this->channel_image_code = self::stringFrom($data, 'channel_image_code');
        $this->delete             = self::boolFrom($data, 'delete');
        $this->success            = self::boolFrom($data, 'success');
    }

    public function setChannelID($arg): void
    {
        $this->channel_id = self::toInt($arg);
    }

    public function setChannelImageCode($arg): void
    {
        $this->channel_image_code = self::toString($arg);
    }

    public function setDelete($arg): void
    {
        $this->delete = self::toBool($arg);
    }

    public function setSuccess($arg): void
    {
        $this->success = self::toBool($arg);
    }

    public function getChannelID(): ?int
    {
        return $this->channel_id;
    }

    public function getChannelImageCode(): ?string
    {
        return $this->channel_image_code;
    }

    public function getDelete(): ?bool
    {
        return $this->delete;
    }

    public function getSuccess(): ?bool
    {
        return $this->success;
    }

}
