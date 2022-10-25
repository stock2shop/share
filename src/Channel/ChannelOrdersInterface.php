<?php

declare(strict_types=1);

namespace Stock2Shop\Share\Channel;

use Stock2Shop\Share\DTO;

interface ChannelOrdersInterface
{
    /**
     * @param DTO\ChannelOrderWebhook[] $channelOrderWebhooks
     * @return DTO\ChannelOrder[]
     */
    public function sync(array $channelOrderWebhooks, DTO\Channel $channel): array;
}
