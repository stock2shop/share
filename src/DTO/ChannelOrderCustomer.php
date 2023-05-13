<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

/**
 * @psalm-type TypeChannelOrderCustomer = array{
 *     accepts_marketing?: bool|null,
 *     channel_customer_code?: string|null,
 *     email?: string|null,
 *     first_name?: string|null,
 *     last_name?: string|null
 * }
 */
class ChannelOrderCustomer extends Customer
{
    public ?string $channel_customer_code;

    /**
     * @param TypeChannelOrderCustomer $data
     */
    public function __construct(array $data)
    {
        /** @psalm-suppress InvalidArgument */
        parent::__construct($data);

        $this->channel_customer_code = self::stringFrom($data, 'channel_customer_code');
    }
}
