<?php

namespace Stock2Shop\DTO;

class Source extends BaseAbstract
{

    /** @var int $id */
    public $id;

    /** @var int $id */
    public $source_id;

    /** @var string $description */
    public $description;

    /** @var int $client_id */
    public $client_id;

    /** @var string $type */
    public $type;

    /** @var string $sync_token */
    public $sync_token;

    /** @var string $active */
    public $active;

    /** @var Meta[] $meta */
    public $meta;

    /**
     * Source constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->id          = static::intFrom($data, 'id');
        $this->client_id   = static::intFrom($data, 'client_id');
        $this->source_id   = static::intFrom($data, 'source_id');
        $this->description = static::stringFrom($data, 'description');
        $this->active      = static::boolFrom($data, 'active');
        $this->type        = static::stringFrom($data, 'type');
        $this->sync_token  = static::stringFrom($data, 'sync_token');
        $this->meta        = Meta::createArray(self::arrayFrom($data, "meta"));
    }
}