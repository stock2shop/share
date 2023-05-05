<?php

declare(strict_types=1);

namespace Stock2Shop\Share\Channel;

/**
 * @psalm-type ChannelConfig = array{
 *     key: string,
 *     value: string,
 *     description: string
 * }
 */
interface ConfigInterface
{
    /**
     * @return array<int, ChannelConfig>
     */
    public function getChannelConfig(): array;

    /**
     * @return array<int, ChannelConfig>
     */
    public function getProductConfig(): array;

    /**
     * @return array<int, ChannelConfig>
     */
    public function getOrderConfig(): array;
}
