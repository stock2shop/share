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

        //Only constructor that should error
        /** @psalm-suppress InvalidArgument */
        new DTO\Log([]);

        // Test arrays and subclass types
        // Meta
        new DTO\Channel([
            'meta' => [['key' => 'foo']]
        ]);
        new DTO\Channel([
            'meta' => [new DTO\Meta(['key' => 'foo'])]
        ]);

        // line_items, shipping_lines, tax_lines
        new DTO\ChannelOrder([
            'line_items' => [
                [
                    'sku' => 'some sku',
                    'tax_lines' => [['code' => 'taxed']]
                ]
            ],
            'shipping_lines' => [['title' => 'some title']]
        ]);
        new DTO\ChannelOrder([
            'line_items' => [
                new DTO\ChannelOrderItem([
                    'sku' => 'some sku',
                    'tax_lines' => [new DTO\OrderItemTax(['code' => 'taxed'])]
                ])
            ],
            'shipping_lines' => [new DTO\ChannelOrderShippingLine(['title' => 'some title'])]
        ]);

        //customer, fulfillments, shipping_address
        new DTO\SystemOrder([
            'customer'          => [['accepts_marketing' => false]],
            'fulfillments'      => [['fulfillmentservice_id' => 123]],
            'history'           => [['instruction' => 'add_order']],
            'shipping_address'  => ['address1' => '1 Test lane']
        ]);
        new DTO\SystemOrder([
            'customer'          => [new DTO\SystemCustomer(['accepts_marketing' => false])],
            'fulfillments'      => [new DTO\SystemFulfillment(['fulfillmentservice_id' => 123])],
            'history'           => [new DTO\SystemOrderHistory(['instruction' => 'add_order'])],
            'shipping_address'  => new DTO\SystemOrderAddress(['address1' => '1 Test lane'])
        ]);

        //images, options, variants
        new DTO\ChannelProduct([
            'active' => true,
            'images' => [['active' => true]],
            'options' => [['name' => 'Option name']],
            'variants' => [['active' => true]]
        ]);
        new DTO\ChannelProduct([
            'active' => true,
            'images' => [new DTO\ChannelImage(['active' => true])],
            'options' => [new DTO\ProductOption(['name' => 'Option name'])],
            'variants' => [new DTO\ChannelVariant(['active' => true])]
        ]);

        // channel_products
        new DTO\ChannelProducts([
            'channel_products' => [['active' => true]]
        ]);
        new DTO\ChannelProducts([
            'channel_products' => [new DTO\ChannelProduct(['active' => true])]
        ]);

        //price_tiers on ChannelVariant
        //qty_availability on ChannelVariant
        new DTO\ChannelVariant([
            'price_tiers'       => [['tier' => 'Some price tier']],
            'qty_availability'  => [['description' => 'Some warehouse name']]
        ]);
        new DTO\ChannelVariant([
            'price_tiers'       => [new DTO\PriceTier(['tier' => 'Some price tier'])],
            'qty_availability'  => [new DTO\QtyAvailability(['description' => 'Some warehouse name'])]
        ]);

        //addresses, user
        new DTO\SystemCustomer([
            'addresses' => [['address1' => '1 Test lane']],
            'user'      => ['customer_id'=> 123]
        ]);
        new DTO\SystemCustomer([
            'addresses' => [new DTO\Address(['address1' => '1 Test lane'])],
            'user'      => new DTO\User(['customer_id'=> 123])
        ]);

        //channels on SystemProduct
        new DTO\SystemProduct([
            'channels' => [['active' => true]]
        ]);
        new DTO\SystemProduct([
            'channels' => [new DTO\Channel(['active' => true])]
        ]);
    }

}