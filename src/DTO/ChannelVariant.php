<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

use JsonSerializable;

class ChannelVariant extends Variant implements JsonSerializable, DTOInterface
{
    public ?int $channel_id;
    public ?string $channel_variant_code;
    public ?int $client_id;
    public ?bool $delete;
    public ?string $hash;
    public ?int $id;
    public ?int $image_id;
    public ?int $product_id;
    public ?bool $success;

    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->channel_id           = self::intFrom($data, 'channel_id');
        $this->channel_variant_code = self::stringFrom($data, 'channel_variant_code');
        $this->client_id            = static::intFrom($data, 'client_id');
        $this->delete               = self::boolFrom($data, 'delete');
        $this->hash                 = static::stringFrom($data, 'hash');
        $this->id                   = static::intFrom($data, 'id');
        $this->image_id             = static::intFrom($data, 'image_id');
        $this->product_id           = static::intFrom($data, 'product_id');
        $this->success              = self::boolFrom($data, 'success');
    }

    public static function createFromJSON(string $json): ChannelVariant
    {
        $data = json_decode($json, true);
        return new ChannelVariant($data);
    }

    public function jsonSerialize(): array
    {
        return (array)$this;
    }

    /**
     * @return ChannelVariant[]
     */
    public static function createArray(array $data): array
    {
        $a = [];
        foreach ($data as $item) {
            $a[] = new ChannelVariant((array)$item);
        }
        return $a;
    }
}
