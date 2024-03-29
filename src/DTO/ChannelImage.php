<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

use JsonSerializable;

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
class ChannelImage extends Image implements JsonSerializable, DTOInterface
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

    public static function createFromJSON(string $json): ChannelImage
    {
        $data = json_decode($json, true);
        return new ChannelImage($data);
    }

    public function jsonSerialize(): array
    {
        return (array)$this;
    }

    /**
     * @return ChannelImage[]
     */
    public static function createArray(array $data): array
    {
        $a = [];
        foreach ($data as $item) {
            $a[] = new ChannelImage((array)$item);
        }
        return $a;
    }
}
