<?php

declare(strict_types=1);

namespace Stock2Shop\Share\Channel;

/**
 * Each channel must extend this class in order to load its code
 * using a Factory Pattern approach.
 *
 */
abstract class ChannelCreator
{
    abstract public function createChannelProducts(): ChannelProductsInterface;
}
