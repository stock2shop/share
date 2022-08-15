<?php
namespace Stock2Shop\Factory;

use Stock2Shop\DTO;

interface ChannelFulfillmentsInterface {

    /**
     * Sync
     *
     * This method synchronises Fulfillments from Stock2Shop to the channel.
     *
     * @param ChannelFulfillmentsSync $ChannelFulfillmentsSync
     * @return DTO\Fulfillment[]
     */
//    public function sync(vo\Fulfillment $ChannelFulfillments, vo\Channel $channel): array;

    /**
     * Get By Order Code
     *
     * The following properties must be set:-
     * - channel_fulfillment_code
     *
     * @param DTO\Fulfillment[] $channelFulfillments
     * @param array $channelOrderCodes
     * @return DTO\Fulfillment[]
     */
//    public function getFulfillmentsByOrderCode(array $channelOrderCodes, vo\Channel $channel): array;
}

