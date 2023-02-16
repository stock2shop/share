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
    public ?string $hash;
    public ?string $modified;

    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->id         = self::intFrom($data, "id");
        $this->channel_id = self::intFrom($data, 'channel_id');
        $this->client_id  = self::intFrom($data, 'client_id');
        $this->created    = self::stringFrom($data, 'created');
        $this->hash       = self::stringFrom($data, 'hash');
        $this->modified   = self::stringFrom($data, 'modified');
    }

    public function computeHash(): string
    {
        $a = new SystemOrderAddress((array)$this);

        // unset fields that we do not want included in the hash
        unset($a->id);
        unset($a->channel_id);
        unset($a->client_id);
        unset($a->created);
        unset($a->hash);
        unset($a->modified);
        $json = json_encode($a);
        return md5($json);
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
