<?php

namespace Stock2Shop\Share\DTO;

use JsonSerializable;

class SystemOrderItemFulfillment extends DTO implements JsonSerializable, DTOInterface
{
    public ?int $fulfilled_qty;
    public ?int $fulfillment_id;
    public ?string $status;
    public ?int $qty;

    public function __construct(array $data)
    {
        $this->fulfilled_qty  = self::intFrom($data, "fulfilled_qty");
        $this->fulfillment_id = self::intFrom($data, "fulfillment_id");
        $this->status         = self::stringFrom($data, "status");
        $this->qty            = self::intFrom($data, "qty");
    }

    public function jsonSerialize(): array
    {
        return (array)$this;
    }

    public static function createFromJSON(string $json): SystemOrderItemFulfillment
    {
        $data = json_decode($json, true);
        return new SystemOrderItemFulfillment($data);
    }

    /**
     * @return SystemOrderItemFulfillment[]
     */
    public static function createArray(array $data): array
    {
        $a = [];
        foreach ($data as $item) {
            $a[] = new SystemOrderItemFulfillment((array)$item);
        }
        return $a;
    }
}
