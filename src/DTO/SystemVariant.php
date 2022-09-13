<?php

namespace Stock2Shop\Share\DTO;

class SystemVariant extends Variant
{
    protected ?int      $client_id;
    protected ?string   $hash;
    protected ?int      $id;
    protected ?int      $image_id;
    protected ?int      $product_id;

    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->client_id  = static::intFrom($data, 'client_id');
        $this->hash       = static::stringFrom($data, 'hash');
        $this->id         = static::intFrom($data, 'id');
        $this->image_id   = static::intFrom($data, 'image_id');
        $this->product_id = static::intFrom($data, 'product_id');
    }

    public function setClientID($arg): void
    {
        $this->client_id = self::toInt($arg);
    }

    public function setHash($arg): void
    {
        $this->hash = self::toString($arg);
    }

    public function setID($arg): void
    {
        $this->id = self::toInt($arg);
    }

    public function setImageID($arg): void
    {
        $this->image_id = self::toInt($arg);
    }

    public function setProductID($arg): void
    {
        $this->product_id = self::toInt($arg);
    }

    public function getClientID(): ?int
    {
        return $this->client_id;
    }

    public function getHash(): ?string
    {
        return $this->hash;
    }

    public function getID(): ?int
    {
        return $this->id;
    }

    public function getImageID(): ?int
    {
        return $this->image_id;
    }

    public function getProductID(): ?int
    {
        return $this->product_id;
    }

    /**
     * Computes a hash of the SystemVariant
     */
    public function computeHash(): string
    {
        return parent::computeHash();
    }
}
