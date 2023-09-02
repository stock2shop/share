<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

/**
 * @psalm-type TypeChannelOrderWebhook = array{
 *     payload?: string|null,
 *     storage_code?: string|null
 * }
 */
class ChannelOrderWebhook extends DTO
{
    public ?string $storage_code;
    public ?string $payload;

    /**
     * @param TypeChannelOrderWebhook $data
     */
    public function __construct(array $data)
    {
        $this->storage_code = self::stringFrom($data, 'storage_code');
        $this->payload      = self::stringFrom($data, 'payload');
    }
}
