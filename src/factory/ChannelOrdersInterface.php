<?php
namespace stock2shop\share\factory;

use stock2shop\share\dto;

/**
 * Interface Orders
 * @package stock2shop\dal\channel
 */
interface ChannelOrdersInterface {

    /**
     * Get
     *
     * This method must define the workflow for getting orders from a channel.
     *
     * The '$token' parameter will either be an empty string "" or it may contain
     * a string value with one of the `vo\ChannelOrder` properties to search on.
     * When '$token' is an empty string: all orders must be returned.
     *
     * The '$limit' parameter specifies the maximum number of order objects to return.
     * Your implementation will need to include conditional logic for this which is
     * compatible with your channel's API.
     *
     * You may supplement the workflow here with the '$channel' object's meta property
     * items. (holds an array of `vo\Meta` objects).
     *
     * @param string $token
     * @param int $limit
     * @param dto\Channel $channel
     * @return dto\ChannelOrder[]
     */
//    public function get(string $token, int $limit, vo\Channel $channel): array;

    /**
     * Get By Code
     *
     * The purpose of this method is to return an array of orders which have
     * been transformed from the format used by the channel into `vo\ChannelOrder`
     * objects.
     *
     * Only orders which match the `channel_order_code` of each order in the '$orders'
     * array parameter must be returned by this method. If any of the orders passed
     * to this function do not have a `channel_order_code` set, then they are ignored
     * and the function must continue.
     *
     * @param dto\ChannelOrder[] $orders
     * @param dto\Channel $channel
     * @return dto\ChannelOrder[]
     */
//    public function getByCode(array $orders, vo\Channel $channel): array;

    /**
     * Transform
     *
     * This method should define the workflow for converting a "webhook" order
     * coming into Stock2Shop into a `vo\ChannelOrder` object.
     *
     * @param mixed $webhookOrder
     * @param dto\Channel $channel
     * @return dto\ChannelOrder
     */
//    public function transform($webhookOrder, vo\Channel $channel): vo\ChannelOrder;

}

