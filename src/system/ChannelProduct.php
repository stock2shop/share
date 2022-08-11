<?php

namespace stock2shop\share\system;

use stock2shop\share\dto;

class ChannelProduct
{
    /**
     * @param dto\ChannelProduct[] $cps
     * @return dto\ChannelProduct[]
     */
    function populate(array $cps): array
    {
        // This would read from DB
        foreach ($cps as $cp) {
            $cp->source_product_code = $cp->id;
            $cp->title               = 'Title ' . $cp->id;
            $cv                      = new dto\ChannelVariant([
                'sku'                 => 'sku-' . $cp->id,
                'source_variant_code' => 'svc-' . $cp->id,
                'price'               => 100 + $cp->id,
                'qty'                 => $cp->id
            ]);
            $cp->variants = [$cv];
        }
        return $cps;
    }
}
