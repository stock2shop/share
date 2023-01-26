<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

use JsonSerializable;

class SystemOrderAddress extends Address implements JsonSerializable, DTOInterface
{
    public ?int $id;
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

    public static function createFromJSON(string $json): SystemOrderAddress
    {
        $data = json_decode($json, true);
        return new SystemOrderAddress($data);
    }

    public function jsonSerialize(): array
    {
        return (array)$this;
    }

    /**
     * @return SystemOrderAddress[]
     */
    public static function createArray(array $data): array
    {
        $a = [];
        foreach ($data as $item) {
            $a[] = new SystemOrderAddress((array)$item);
        }
        return $a;
    }
}
