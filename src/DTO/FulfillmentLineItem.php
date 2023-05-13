<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

/**
 * @psalm-type TypeFulfillmentLineItem = array{
 *     fulfilled_qty?: int|null,
 *     grams?: int|null,
 *     qty?: int|null,
 *     sku?: string|null
 * }
 */
class FulfillmentLineItem extends DTO
{
    public ?int $grams;
    public ?int $qty;
    public ?string $sku;
    public ?int $fulfilled_qty;

    /**
     * @param TypeFulfillmentLineItem $data
     */
    public function __construct(array $data)
    {
        $this->grams         = self::intFrom($data, "grams");
        $this->qty           = self::intFrom($data, "qty");
        $this->sku           = self::stringFrom($data, "sku");
        $this->fulfilled_qty = self::intFrom($data, "fulfilled_qty");
    }
}
