<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

use JsonSerializable;

class Fulfillment extends DTO implements JsonSerializable, DTOInterface
{
    public ?string $fulfillmentservice_order_code;
    /** @var FulfillmentLineItem[] $line_items */
    public array $line_items;
    public ?string $notes;
    public ?string $state;
    public ?string $status;
    public ?string $tracking_company;
    public ?int $tracking_number;
    public ?string $tracking_url;

    public function __construct(array $data)
    {
        $line_items = FulfillmentLineItem::createArray(self::arrayFrom($data, 'line_items'));

        $this->fulfillmentservice_order_code = self::stringFrom($data, 'fulfillmentservice_order_code');
        $this->line_items                    = self::sortArray($line_items, 'sku');
        $this->notes                         = self::stringFrom($data, 'notes');
        $this->state                         = self::stringFrom($data, "state");
        $this->status                        = self::stringFrom($data, 'status');
        $this->tracking_company              = self::stringFrom($data, 'tracking_company');
        $this->tracking_number               = self::intFrom($data, 'tracking_number');
        $this->tracking_url                  = self::stringFrom($data, 'tracking_url');
    }

    public static function createFromJSON(string $json): Fulfillment
    {
        $data = json_decode($json, true);
        return new Fulfillment($data);
    }

    public function jsonSerialize(): array
    {
        return (array)$this;
    }

    /**
     * @return Fulfillment[]
     */
    public static function createArray(array $data): array
    {
        $a = [];
        foreach ($data as $item) {
            $a[] = new Fulfillment((array)$item);
        }
        return $a;
    }
}
