<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

use JsonSerializable;

class SystemOrderItemTax extends OrderItemTax implements JsonSerializable, DTOInterface
{
    public ?int $client_id;
    public ?string $created;
    public ?string $modified;
    public ?int $order_item_id;

    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->client_id              = self::intFrom($data, 'client_id');
        $this->created                = self::stringFrom($data, "created");
        $this->modified               = self::stringFrom($data, "modified");
        $this->order_item_id          = self::intFrom($data, 'order_item_id');
    }

    public function jsonSerialize(): array
    {
        return (array)$this;
    }

    public static function createFromJSON(string $json): SystemOrderItemTax
    {
        $data = json_decode($json, true);
        return new SystemOrderItemTax($data);
    }

    /**
     * @return SystemOrderItem[]
     */
    public static function createArray(array $data): array
    {
        $a = [];
        foreach ($data as $item) {
            $a[] = new SystemOrderItemTax((array)$item);
        }
        return $a;
    }
}
