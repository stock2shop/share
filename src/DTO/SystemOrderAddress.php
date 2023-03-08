<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

use JsonSerializable;

/**
 * @psalm-type TypeSystemOrderAddress = array{
 *     id?: int|null,
 *     channel_id?: int|null,
 *     client_id?: int|null,
 *     created?: string|null,
 *     hash?: string|null,
 *     modified?: string|null,
 *     address1?: string|null,
 *     address2?: string|null,
 *     city?: string|null,
 *     company?: string|null,
 *     country?: string|null,
 *     country_code?: string|null,
 *     first_name?: string|null,
 *     last_name?: string|null,
 *     phone?: string|null,
 *     province?: string|null,
 *     province_code?: string|null,
 *     type?: string|null,
 *     zip?: string|null
 * }
 */
class SystemOrderAddress extends Address implements JsonSerializable, DTOInterface
{
    public ?int $id;
    public ?int $channel_id;
    public ?int $client_id;
    public ?string $created;
    public ?string $hash;
    public ?string $modified;

    /**
     * @param TypeSystemOrderAddress $data
     */
    public function __construct(array $data)
    {
        /** @psalm-suppress InvalidArgument */
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
