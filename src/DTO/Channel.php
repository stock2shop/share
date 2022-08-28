<?php

namespace Stock2Shop\Share\DTO;

class Channel extends AbstractBase
{

    /** @var bool|null $active */
    protected $active;

    /** @var int|null $client_id */
    protected $client_id;

    /** @var string|null $client_id */
    protected $created;

    /** @var string|null $description */
    protected $description;

    /** @var int|null $id */
    protected $id;

    /** @var Meta[] $meta */
    protected $meta;

    /** @var string|null $modified */
    protected $modified;

    /** @var string|null $price_tier */
    protected $price_tier;

    /** @var string|null $qty_availabilty */
    protected $qty_availability;

    /** @var string|null $sync_token */
    protected $sync_token;

    /** @var string|null $type */
    protected $type;

    /**
     * Channel constructor.
     * @param array $data
     */
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

    public function setActive($arg)
    {
        $this->active = self::toBool($arg);
    }

    public function setClientID($arg)
    {
        $this->client_id = self::toInt($arg);
    }

    public function setCreated($arg)
    {
        $this->created = self::toString($arg);
    }

    public function setDescription($arg)
    {
        $this->description = self::toString($arg);
    }

    public function setID($arg)
    {
        $this->id = self::toInt($arg);
    }

    public function setMeta($arg)
    {
        $this->meta = Meta::createArray($arg);
    }

    public function setModified($arg)
    {
        $this->modified = self::toString($arg);
    }

    public function setPriceTier($arg)
    {
        $this->price_tier = self::toString($arg);
    }

    public function setQtyAvailability($arg)
    {
        $this->qty_availability = self::toString($arg);
    }

    public function setSyncToken($arg)
    {
        $this->sync_token = self::toString($arg);
    }

    public function setType($arg)
    {
        $this->type = self::toString($arg);
    }

    public function getActive()
    {
        return $this->active;
    }

    public function getClientID()
    {
        return $this->client_id;
    }

    public function getCreated()
    {
        return $this->created;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getID()
    {
        return $this->id;
    }

    public function getMeta()
    {
        return $this->meta;
    }

    public function getModified()
    {
        return $this->modified;
    }

    public function getPriceTier()
    {
        return $this->price_tier;
    }

    public function getQtyAvailability()
    {
        return $this->qty_availability;
    }

    public function getSyncToken()
    {
        return $this->sync_token;
    }

    public function getType()
    {
        return $this->type;
    }
}
