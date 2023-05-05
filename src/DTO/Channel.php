<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

use JsonSerializable;
use Stock2Shop\Share\Iterator;

/**
 * @psalm-import-type TypeMeta from Meta
 * @psalm-type TypeChannel = array{
 *     active?: bool|null,
 *     client_id?: int|null,
 *     created?: string|null,
 *     description?: string|null,
 *     id?: int|null,
 *     meta?: array<int, TypeMeta>|array<int, Meta>,
 *     modified?: string|null,
 *     price_tier?: string|null,
 *     qty_availability?: string|null,
 *     sync_token?: string|null,
 *     type?: string|null
 * }
 */
class Channel extends DTO implements JsonSerializable, DTOInterface
{
    public ?bool $active;
    public ?int $client_id;
    public ?string $created;
    public ?string $description;
    public ?int $id;
    /** @var Iterator<Meta> $meta */
    public Iterator $meta;
    public ?string $modified;
    public ?string $price_tier;
    public ?string $qty_availability;
    public ?string $sync_token;
    public ?string $type;

    /**
     * @param TypeChannel $data
     */
    public function __construct(array $data)
    {
        $this->active           = self::boolFrom($data, 'active');
        $this->client_id        = self::intFrom($data, 'client_id');
        $this->created          = self::stringFrom($data, 'created');
        $this->description      = self::stringFrom($data, 'description');
        $this->id               = self::intFrom($data, 'id');
        $this->meta             = Meta::createIterable(self::arrayFrom($data, "meta"));
        ;
        $this->modified         = self::stringFrom($data, 'modified');
        $this->price_tier       = self::stringFrom($data, 'price_tier');
        $this->qty_availability = self::stringFrom($data, 'qty_availability');
        $this->sync_token       = self::stringFrom($data, 'sync_token');
        $this->type             = self::stringFrom($data, 'type');
    }

    public function jsonSerialize(): array
    {
        return (array)$this;
    }

    public static function createFromJSON(string $json): Channel
    {
        $data = json_decode($json, true);
        return new Channel($data);
    }

    /**
     * @return Channel[]
     */
    public static function createArray(array $data): array
    {
        $a = [];
        foreach ($data as $item) {
            $a[] = new Channel((array)$item);
        }
        return $a;
    }
}
