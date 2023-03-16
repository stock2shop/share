<?php

declare(strict_types=1);

namespace Stock2Shop\Tests\Share;

use Stock2Shop\Share\DTO;

/**
 * Check so we can see that IDE does not report errors when constructing DTOs
 */
class PsalmCheck
{

    public function psalmTypeCheck(): void
    {
        // Check empty constructors
        new DTO\Address([]);
        new DTO\Channel([]);
        new DTO\ChannelImage([]);
        new DTO\ChannelImageChannel([]);
        new DTO\ChannelOrder([]);
        new DTO\ChannelOrderAddress([]);
        new DTO\ChannelOrderCustomer([]);
        new DTO\ChannelOrderItem([]);
        new DTO\ChannelOrderShippingLine([]);
        new DTO\ChannelOrderWebhook([]);
        new DTO\ChannelProduct([]);
        new DTO\ChannelProductChannel([]);
        new DTO\ChannelProducts([]);
        new DTO\ChannelVariant([]);
        new DTO\ChannelVariantChannel([]);
        new DTO\Customer([]);
        new DTO\Fulfillment([]);
        new DTO\FulfillmentLineItem([]);
        new DTO\Image([]);

        //Only constructor that should error
        /** @psalm-suppress InvalidArgument */
        new DTO\Log([]);

        new DTO\Meta([]);
        new DTO\Order([]);
        new DTO\OrderItem([]);
        new DTO\OrderItemTax([]);
        new DTO\OrderMeta([]);
        new DTO\OrderShippingLine([]);
        new DTO\OrderSource([]);
        new DTO\PriceTier([]);
        new DTO\Product([]);
        new DTO\ProductOption([]);
        new DTO\QtyAvailability([]);
        new DTO\Segment([]);
        new DTO\ServiceFulfillment([]);
        new DTO\SystemCustomer([]);
        new DTO\SystemFulfillment([]);
        new DTO\SystemFulfillmentLineItem([]);
        new DTO\SystemImage([]);
        new DTO\SystemOrder([]);
        new DTO\SystemOrderAddress([]);
        new DTO\SystemOrderHistory([]);
        new DTO\SystemOrderItem([]);
        new DTO\SystemOrderShippingLine([]);
        new DTO\SystemProduct([]);
        new DTO\SystemProducts([]);
        new DTO\SystemVariant([]);
        new DTO\User([]);
        new DTO\Variant([]);

        // using either dto or array example
        new DTO\Channel([
            'meta' => [['key' => 'foo']]
        ]);
        new DTO\Channel([
            'meta' => [new DTO\Meta(['key' => 'foo'])]
        ]);
    }

}