<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

use JsonSerializable;

/**
 * @psalm-import-type TypeFulfillmentLineItem from FulfillmentLineItem
 * @psalm-type TypeServiceFulfillment = array{
 *     line_items: TypeFulfillmentLineItem,
 *     fulfillmentservice_order_code?: string,
 *     notes?: string,
 *     status?: string,
 *     tracking_company?: string,
 *     tracking_number?: string,
 *     tracking_url?: string
 * }
 */
class ServiceFulfillment extends Fulfillment implements JsonSerializable, DTOInterface
{
    /** @var FulfillmentLineItem[] $line_items */
    public array $line_items;

    /**
     * @param TypeServiceFulfillment $data
     */
    public function __construct(array $data)
    {
        /** @psalm-suppress InvalidArgument */
        parent::__construct($data);

        $line_items = FulfillmentLineItem::createArray(self::arrayFrom($data, 'line_items'));

        $this->line_items = self::sortArray($line_items, 'sku');
    }

    public static function createFromJSON(string $json): ServiceFulfillment
    {
        $data = json_decode($json, true);
        return new ServiceFulfillment($data);
    }

    public function jsonSerialize(): array
    {
        return (array)$this;
    }

    /**
     * @return ServiceFulfillment[]
     */
    public static function createArray(array $data): array
    {
        $a = [];
        foreach ($data as $item) {
            $a[] = new ServiceFulfillment((array)$item);
        }
        return $a;
    }
}
