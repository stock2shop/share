<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

use JsonSerializable;
use Stock2Shop\Share\Utils\Date;

/**
 * @psalm-import-type TypeSystemFulfillmentLineItem from SystemFulfillmentLineItem
 * @psalm-import-type TypeSystemOrderAddress from SystemOrderAddress
 * @psalm-type TypeSystemFulfillment = array{
 *     channel_id?: int|null,
 *     channel_synced?: string|null,
 *     client_id?: int|null,
 *     created?: string|null,
 *     fulfillmentservice_id?: int|null,
 *     fulfillmentservice_order_code?: string|null,
 *     id?: int|null,
 *     line_items?: array<int, TypeSystemFulfillmentLineItem>|array<int, SystemFulfillmentLineItem>,
 *     modified?: string|null,
 *     notes?: string|null,
 *     order_id?: int|null,
 *     shipping_address?: TypeSystemOrderAddress|SystemOrderAddress,
 *     state?: string|null,
 *     status?: string|null,
 *     tracking_company?: string|null,
 *     tracking_number?: string|null,
 *     tracking_url?: string|null
 * }
 */
class SystemFulfillment extends Fulfillment implements JsonSerializable, DTOInterface
{
    public ?int $channel_id;
    public ?int $client_id;
    public ?string $created;
    public ?int $fulfillmentservice_id;
    public ?int $id;
    /** @var SystemFulfillmentLineItem[] $line_items */
    public array $line_items;
    public ?string $modified;
    public ?int $order_id;
    public SystemOrderAddress $shipping_address;
    public ?string $channel_synced;

    /**
     * @param TypeSystemFulfillment $data
     */
    public function __construct(array $data)
    {
        /** @psalm-suppress InvalidArgument */
        parent::__construct($data);

        $line_items = SystemFulfillmentLineItem::createArray(self::arrayFrom($data, 'line_items'));

        $this->channel_id            = self::intFrom($data, 'channel_id');
        $this->channel_synced        = self::dateStringFrom($data, 'channel_synced', Date::FORMAT_MS);
        $this->client_id             = self::intFrom($data, 'client_id');
        $this->created               = self::stringFrom($data, 'created');
        $this->fulfillmentservice_id = self::intFrom($data, 'fulfillmentservice_id');
        $this->id                    = self::intFrom($data, 'id');
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
