<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

use JsonSerializable;

class SystemOrderFulfillment extends DTO implements JsonSerializable, DTOInterface
{
    public ?int $fulfillmentservice_id;
    public ?string $fulfillmentservice_order_code;
    public ?string $state;
    public ?string $status;
    public ?string $tracking_number;
    public ?string $tracking_company;
    public ?string $tracking_url;
    public ?string $notes;


    public function __construct(array $data)
    {
        $this->fulfillmentservice_id         = self::intFrom($data, "fulfillmentservice_id");
        $this->fulfillmentservice_order_code = self::stringFrom($data, "fulfillmentservice_order_code");
        $this->state                         = self::stringFrom($data, "state");
        $this->status                        = self::stringFrom($data, "status");
        $this->tracking_number               = self::stringFrom($data, "tracking_number");
        $this->tracking_company              = self::stringFrom($data, "tracking_company");
        $this->tracking_url                  = self::stringFrom($data, "tracking_url");
        $this->notes                         = self::stringFrom($data, "notes");
    }

    public function jsonSerialize(): array
    {
        return (array)$this;
    }

    public static function createFromJSON(string $json): SystemOrderFulfillment
    {
        $data = json_decode($json, true);
        return new SystemOrderFulfillment($data);
    }

    /**
     * @return SystemOrderFulfillment[]
     */
    public static function createArray(array $data): array
    {
        $a = [];
        foreach ($data as $item) {
            $a[] = new SystemOrderFulfillment((array)$item);
        }
        return $a;
    }
}
