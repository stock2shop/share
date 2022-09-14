<?php
declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

class Channel extends DTO
{
    public ?bool $active;
    public ?int $client_id;
    public ?string $created;
    public ?string $description;
    public ?int $id;
    /** @var Meta[] $meta */
    public array $meta;
    public ?string $modified;
    public ?string $price_tier;
    public ?string $qty_availability;
    public ?string $sync_token;
    public ?string $type;

    public function __construct(array $data)
    {
        $this->active           = self::boolFrom($data, 'active');
        $this->client_id        = self::intFrom($data, 'client_id');
        $this->created          = self::stringFrom($data, 'created');
        $this->description      = self::stringFrom($data, 'description');
        $this->id               = self::intFrom($data, 'id');
        $this->meta             = Meta::createArray(self::arrayFrom($data, "meta"));
        $this->modified         = self::stringFrom($data, 'modified');
        $this->price_tier       = self::stringFrom($data, 'price_tier');
        $this->qty_availability = self::stringFrom($data, 'qty_availability');
        $this->sync_token       = self::stringFrom($data, 'sync_token');
        $this->type             = self::stringFrom($data, 'type');
    }
}
