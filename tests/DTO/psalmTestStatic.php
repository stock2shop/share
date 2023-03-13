<?php

declare(strict_types=1);

namespace Stock2Shop\Tests\Share\DTO;

use Stock2Shop\Share\DTO;

/**
 * The below is to see if Psalm is assisting with type issues
 * No Runtime test is active here
 */
class PsalmTest {

    public function TestPsalm(): void
    {
        $a      = new DTO\Address([]);
        $c      = new DTO\Channel([]);
        $ci     = new DTO\ChannelImage([]);
        $cic    = new DTO\ChannelImageChannel([]);
        $co     = new DTO\ChannelOrder([]);
        $coa    = new DTO\ChannelOrderAddress([]);
        $coc    = new DTO\ChannelOrderCustomer([]);
        $coi    = new DTO\ChannelOrderItem([]);
        $cosl   = new DTO\ChannelOrderShippingLine([]);
        $cow    = new DTO\ChannelOrderWebhook([]);
        $cp     = new DTO\ChannelProduct([]);
        $cpc    = new DTO\ChannelProductChannel([]);
        $cps    = new DTO\ChannelProducts([]);
        $cv     = new DTO\ChannelVariant([]);
        $cvc    = new DTO\ChannelVariantChannel([]);
        $cu     = new DTO\Customer([]);
        $f      = new DTO\Fulfillment([]);
        $fl     = new DTO\FulfillmentLineItem([]);
        $i      = new DTO\Image([]);

        //Only constructor that should error
        $l      = new DTO\Log([]);

        $m      = new DTO\Meta([]);
        $o      = new DTO\Order([]);
        $oi     = new DTO\OrderItem([]);
        $oit    = new DTO\OrderItemTax([]);
        $om     = new DTO\OrderMeta([]);
        $osl    = new DTO\OrderShippingLine([]);
        $os     = new DTO\OrderSource([]);
        $pt     = new DTO\PriceTier([]);
        $p      = new DTO\Product([]);
        $po     = new DTO\ProductOption([]);
        $qa     = new DTO\QtyAvailability([]);
        $s      = new DTO\Segment([]);
        $sf     = new DTO\ServiceFulfillment([]);
        $scu    = new DTO\SystemCustomer([]);
        $syf    = new DTO\SystemFulfillment([]);
        $syfli  = new DTO\SystemFulfillmentLineItem([]);
        $syi    = new DTO\SystemImage([]);
        $syo    = new DTO\SystemOrder([]);
        $syoa   = new DTO\SystemOrderAddress([]);
        $syoh   = new DTO\SystemOrderHistory([]);
        $syoi   = new DTO\SystemOrderItem([]);
        $syosl  = new DTO\SystemOrderShippingLine([]);
        $syp    = new DTO\SystemProduct([]);
        $syps   = new DTO\SystemProducts([]);
        $syv    = new DTO\SystemVariant([]);
        $u      = new DTO\User([]);
        $v      = new DTO\Variant([]);
    }

}