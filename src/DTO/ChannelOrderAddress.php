<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

/**
 * @psalm-type TypeChannelOrderAddress = array{
 *     address1?: string|null,
 *     address2?: string|null,
 *     city?: string|null,
 *     company?: string|null,
 *     country?: string|null,
 *     country_code?: string|null,
 *     first_name?: string|null,
 *     last_name?: string|null,
 *     phone?: string|null,
 *     province?: string|null,
 *     province_code?: string|null,
 *     zip?: string|null
 *}
 */
class ChannelOrderAddress extends Address
{
    /**
     * @param TypeChannelOrderAddress $data
     */
    public function __construct(array $data)
    {
        parent::__construct($data);
    }
}
