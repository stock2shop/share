<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

/**
 * @psalm-type TypeChannelOrderShippingLine = array{
 *     price?: float|null,
 *     title?: string|null
 * }
 */
class ChannelOrderShippingLine extends OrderShippingLine
{
    /**
     * @param TypeChannelOrderShippingLine $data
     */
    public function __construct(array $data)
    {
        /** @psalm-suppress InvalidArgument */
        parent::__construct($data);
    }
}
