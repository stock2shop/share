<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

use JsonSerializable;

class SystemFulfillment extends Fulfillment implements JsonSerializable, DTOInterface
{
    public ?int $channel_id;
    public ?int $client_id;
    public ?string $created;
    public ?int $fulfillmentservice_id;
    /** @var SystemFulfillmentLineItem[] $line_items */
    public array $line_items;
    public ?string $modified;
    public ?int $order_id;
    public SystemOrderAddress $shipping_address;

    public function __construct(array $data)
    {
        parent::__construct($data);

        $line_items = SystemFulfillmentLineItem::createArray(self::arrayFrom($data, 'line_items'));

        $this->channel_id            = self::intFrom($data, 'channel_id');
        $this->client_id             = self::intFrom($data, 'client_id');
        $this->created               = self::stringFrom($data, 'created');
        $this->fulfillmentservice_id = self::intFrom($data, 'fulfillmentservice_id');
        $this->line_items            = self::sortArray($line_items, 'sku');
        $this->modified              = self::stringFrom($data, 'modified');
        $this->order_id              = self::intFrom($data, 'order_id');
        $this->shipping_address      = new SystemOrderAddress(self::arrayFrom($data, 'shipping_address'));
    }

    public static function createFromJSON(string $json): SystemFulfillment
    {
        $data = json_decode($json, true);
        return new SystemFulfillment($data);
    }

    public function jsonSerialize(): array
    {
        return (array)$this;
    }

    /**
     * @return SystemFulfillment[]
     */
    public static function createArray(array $data): array
    {
        $a = [];
        foreach ($data as $item) {
            $a[] = new SystemFulfillment((array)$item);
        }
        return $a;
    }
}
