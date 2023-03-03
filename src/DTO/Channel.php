<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

use JsonSerializable;
use Stock2Shop\Share\Utils\Date;

class Channel extends DTO implements JsonSerializable, DTOInterface
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
        $meta = Meta::createArray(self::arrayFrom($data, "meta"));

        $this->active           = self::boolFrom($data, 'active');
        $this->client_id        = self::intFrom($data, 'client_id');
        $this->created          = self::dateStringFrom($data, 'created',Date::FORMAT);
        $this->description      = self::stringFrom($data, 'description');
        $this->id               = self::intFrom($data, 'id');
        $this->meta             = $this->sortArray($meta, "key");
        $this->modified         = self::dateStringFrom($data, 'modified',Date::FORMAT);
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
