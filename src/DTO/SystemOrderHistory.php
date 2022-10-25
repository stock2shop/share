<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

use JsonSerializable;

class SystemOrderHistory extends DTO implements JsonSerializable, DTOInterface
{
    public ?string $instruction;
    public ?string $storage_code;
    public ?string $channel_id;
    public ?string $client_id;
    public ?string $created;
    public ?string $modified;


    public function __construct(array $data)
    {
        $this->instruction  = self::stringFrom($data, "instruction");
        $this->storage_code = self::stringFrom($data, "storage_code");
        $this->channel_id   = self::intFrom($data, "channel_id");
        $this->client_id    = self::intFrom($data, "client_id");
        $this->created      = self::stringFrom($data, "created");
        $this->modified     = self::stringFrom($data, "modified");
    }

    public function jsonSerialize(): array
    {
        return (array)$this;
    }

    public static function createFromJSON(string $json): SystemOrderHistory
    {
        $data = json_decode($json, true);
        return new SystemOrderHistory($data);
    }

    /**
     * @return SystemOrderHistory[]
     */
    public static function createArray(array $data): array
    {
        $a = [];
        foreach ($data as $item) {
            $a[] = new SystemOrderHistory((array)$item);
        }
        return $a;
    }
}
