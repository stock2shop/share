<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

/**
 * @psalm-type TypeChannelImage = array{
 *     active?: bool|null,
 *     channel_id?: int|null,
 *     channel_image_code?: string|null,
 *     id?: int|null,
 *     delete?: bool|null,
 *     src?: string|null,
 *     success?: bool|null
 * }
 */
class ChannelImage extends Image
{
    public ?bool $active;
    public ?int $channel_id;
    public ?string $channel_image_code;
    public ?bool $delete;
    public ?int $id;
    public ?bool $success;

    /**
     * @param TypeChannelImage $data
     */
    public function __construct(array $data)
    {
        /** @psalm-suppress InvalidArgument */
        parent::__construct($data);

        $this->active             = self::boolFrom($data, "active");
        $this->channel_id         = self::intFrom($data, 'channel_id');
        $this->channel_image_code = self::stringFrom($data, 'channel_image_code');
        $this->delete             = self::boolFrom($data, 'delete');
        $this->id                 = self::intFrom($data, 'id');
        $this->success            = self::boolFrom($data, 'success');
    }
}
