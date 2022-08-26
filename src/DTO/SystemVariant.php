<?php

namespace Stock2Shop\Share\DTO;

class SystemVariant extends Variant
{
    /** @var int|null $client_id */
    protected $client_id;

    /** @var string|null $hash */
    protected $hash;

    /** @var int|null $id */
    protected $id;

    /** @var int|null $image_id */
    protected $image_id;

    /** @var int|null $product_id */
    protected $product_id;

    /**
     * SystemVariant constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->client_id  = static::intFrom($data, 'client_id');
        $this->hash       = static::stringFrom($data, 'hash');
        $this->id         = static::intFrom($data, 'id');
        $this->image_id   = static::intFrom($data, 'image_id');
        $this->product_id = static::intFrom($data, 'product_id');
    }

    public function setClientID($arg)
    {
        $this->client_id = self::toInt($arg);
    }

    public function setHash($arg)
    {
        $this->hash = self::toString($arg);
    }

    public function setID($arg)
    {
        $this->id = self::toInt($arg);
    }

    public function setImageID($arg)
    {
        $this->image_id = self::toInt($arg);
    }

    public function setProductID($arg)
    {
        $this->product_id = self::toInt($arg);
    }

    /**
     * Computes a hash of the SystemVariant
     * @return string
     */
    public function computeHash(): string
    {
        // Unlike SystemProduct there are no additional properties to include
        return parent::computeHash();
    }
}
