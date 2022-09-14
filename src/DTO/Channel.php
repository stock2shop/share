<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

class Channel extends DTO
{
    public readonly ?bool $active;
    public readonly ?int $client_id;
    public readonly ?string $created;
    public readonly ?string $description;
    public readonly ?int $id;
    /** @var Meta[] $meta */
    public readonly array $meta;
    public readonly ?string $modified;
    public readonly ?string $price_tier;
    public readonly ?string $qty_availability;
    public readonly ?string $sync_token;
    public readonly ?string $type;

    public function __construct(array $data)
    {
        $meta = Meta::createArray(self::arrayFrom($data, "meta"));

        $this->active           = self::boolFrom($data, 'active');
        $this->client_id        = self::intFrom($data, 'client_id');
        $this->created          = self::stringFrom($data, 'created');
        $this->description      = self::stringFrom($data, 'description');
        $this->id               = self::intFrom($data, 'id');
        $this->meta             = $this->sortArray($meta, "key");
        $this->modified         = self::stringFrom($data, 'modified');
        $this->price_tier       = self::stringFrom($data, 'price_tier');
        $this->qty_availability = self::stringFrom($data, 'qty_availability');
        $this->sync_token       = self::stringFrom($data, 'sync_token');
        $this->type             = self::stringFrom($data, 'type');
    }
}
