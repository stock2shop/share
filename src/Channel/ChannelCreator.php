<?php

namespace Stock2Shop\Factory;


/**
 * Each channel must extend this class in order to load its code
 * using a Factory Pattern approach.
 *
 */
abstract class ChannelCreator
{

    /**
     * @return ChannelProductsInterface
     */
    abstract public function createChannelProducts(): ChannelProductsInterface;

    /**
     * @return ChannelOrdersInterface
     */
    abstract public function createChannelOrders(): ChannelOrdersInterface;

    /**
     * @return ChannelFulfillmentsInterface
     */
    abstract public function createChannelFulfillments(): ChannelFulfillmentsInterface;

}

