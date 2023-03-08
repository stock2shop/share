<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

use JsonSerializable;

/**
 * @psalm-type TypeChannelOrderWebhook = array{
 *     payload?: string|null,
 *     storage_code: string
 * }
 */
class ChannelOrderWebhook extends DTO implements JsonSerializable, DTOInterface
{
    public string $storage_code;
    public ?string $payload;

    /**
     * @param TypeChannelOrderWebhook $data
     */
    public function __construct(array $data)
    {
        $this->storage_code = self::stringFrom($data, 'storage_code');
        $this->payload      = self::stringFrom($data, 'payload');
    }

    public static function createFromJSON(string $json): ChannelOrderWebhook
    {
        $data = json_decode($json, true);
        return new ChannelOrderWebhook($data);
    }

    public function jsonSerialize(): array
    {
        return (array)$this;
    }

    /**
     * @return ChannelOrderWebhook[]
     */
    public static function createArray(array $data): array
    {
        $a = [];
        foreach ($data as $item) {
            $a[] = new ChannelOrderWebhook((array)$item);
        }
        return $a;
    }
}
