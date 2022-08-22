<?php

namespace Stock2Shop\Share\DTO;

class SystemChannel extends AbstractBase
{

    /** @var bool|null $active */
    public $active;

    /** @var int|null $client_id */
    public $client_id;

    /** @var string|null $client_id */
    public $created;

    /** @var string|null $description */
    public $description;

    /** @var int|null $id */
    public $id;

    /** @var Meta[] $meta */
    public $meta;

    /** @var string|null $modified */
    public $modified;

    /** @var string|null $price_tier */
    public $price_tier;

    /** @var string|null $qty_availabilty */
    public $qty_availability;

    /** @var string|null $sync_token */
    public $sync_token;

    /** @var string|null $type */
    public $type;

    /**
     * Channel constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->active           = static::boolFrom($data, 'active');
        $this->client_id        = static::intFrom($data, 'client_id');
        $this->created          = static::stringFrom($data, 'created');
        $this->description      = static::stringFrom($data, 'description');
        $this->id               = static::intFrom($data, 'id');
        $this->meta             = Meta::createArray(self::arrayFrom($data, "meta"));
        $this->modified         = static::stringFrom($data, 'modified');
        $this->price_tier       = static::stringFrom($data, 'price_tier');
        $this->qty_availability = static::stringFrom($data, 'qty_availability');
        $this->sync_token       = static::stringFrom($data, 'sync_token');
        $this->type             = static::stringFrom($data, 'type');
    }

    /**
     * Creates an array of this class.
     * @param array $data
     * @return Channel[]
     */
    static function createArray(array $data): array
    {
        $returnable = [];
        foreach ($data as $item) {
            $returnable[] = new SystemChannel((array)$item);
        }
        return $returnable;
    }

}
