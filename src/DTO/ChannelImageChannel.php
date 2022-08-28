<?php

namespace Stock2Shop\Share\DTO;

class ChannelImageChannel extends AbstractBase
{

    /** @var int|null $channel_id */
    protected $channel_id;

    /** @var string $channel_image_code */
    protected $channel_image_code;

    /** @var bool|null $delete */
    protected $delete;

    /** @var bool|null $success */
    protected $success;

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->channel_id         = self::intFrom($data, 'channel_id');
        $this->channel_image_code = self::stringFrom($data, 'channel_image_code');
        $this->delete             = self::boolFrom($data, 'delete');
        $this->success            = self::boolFrom($data, 'success');
    }

    public function setChannelID($arg)
    {
        $this->channel_id = self::toInt($arg);
    }

    public function setChannelImageCode($arg)
    {
        $this->channel_image_code = self::toString($arg);
    }

    public function setDelete($arg)
    {
        $this->delete = self::toBool($arg);
    }

    public function setSuccess($arg)
    {
        $this->success = self::toBool($arg);
    }

    public function getChannelID()
    {
        return $this->channel_id;
    }

    public function getChannelImageCode()
    {
        return $this->channel_image_code;
    }

    public function getDelete()
    {
        return $this->delete;
    }

    public function getSuccess()
    {
        return $this->success;
    }

}
