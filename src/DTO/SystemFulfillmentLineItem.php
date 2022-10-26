<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

use JsonSerializable;

class SystemFulfillmentLineItem extends FulfillmentLineItem implements JsonSerializable, DTOInterface
{
    public ?int $channel_id;
    public ?int $client_id;
    public ?string $created;
    public ?string $modified;

    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->channel_id = self::intFrom($data, 'channel_id');
        $this->client_id  = self::intFrom($data, 'client_id');
        $this->created    = self::stringFrom($data, 'created');
        $this->modified   = self::stringFrom($data, 'modified');
    }

    public function jsonSerialize(): array
    {
        return (array)$this;
    }

    public static function createFromJSON(string $json): SystemFulfillmentLineItem
    {
        $data = json_decode($json, true);
        return new SystemFulfillmentLineItem($data);
    }

    /**
     * @return SystemFulfillmentLineItem[]
     */
    public static function createArray(array $data): array
    {
        $a = [];
        foreach ($data as $item) {
            $a[] = new SystemFulfillmentLineItem((array)$item);
        }
        return $a;
    }
}
