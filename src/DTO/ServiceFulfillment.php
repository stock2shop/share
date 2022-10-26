<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

use JsonSerializable;

class ServiceFulfillment extends Fulfillment implements JsonSerializable, DTOInterface
{
    /** @var FulfillmentLineItem[] $line_items */
    public array $line_items;

    public function __construct(array $data)
    {
        parent::__construct($data);

        $line_items = FulfillmentLineItem::createArray(self::arrayFrom($data, 'tax_lines'));

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
