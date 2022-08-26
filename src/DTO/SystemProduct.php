<?php

namespace Stock2Shop\Share\DTO;

class SystemProduct extends Product
{
    /** @var SystemProductChannel[] $channels */
    protected $channels;

    /** @var int|null $client_id */
    protected $client_id;

    /** @var string|null $created */
    protected $created;

    /** @var string|null $hash */
    protected $hash;

    /** @var int|null $id */
    protected $id;

    /** @var SystemImage[] $images */
    protected $images;

    /** @var string|null $modified */
    protected $modified;

    /** @var int|null $source_id */
    protected $source_id;

    /** @var string|null $source_product_code */
    protected $source_product_code;

    /** @var SystemVariant[] $variants */
    protected $variants;

    /**
     * SystemProduct constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->channels            = SystemProductChannel::createArray(self::arrayFrom($data, 'channels'));
        $this->client_id           = self::intFrom($data, 'client_id');
        $this->created             = self::stringFrom($data, 'created');
        $this->hash                = self::stringFrom($data, 'hash');
        $this->id                  = self::intFrom($data, 'id');
        $this->images              = SystemImage::createArray(self::arrayFrom($data, 'images'));
        $this->modified            = self::stringFrom($data, 'modified');
        $this->source_id           = self::intFrom($data, 'source_id');
        $this->source_product_code = self::stringFrom($data, 'source_product_code');
        $this->variants            = SystemVariant::createArray(self::arrayFrom($data, 'variants'));
    }

    public function setChannels($arg)
    {
        $this->channels = SystemProductChannel::createArray($arg);
    }

    public function setClientID($arg)
    {
        $this->client_id = self::toInt($arg);
    }

    public function setCreated($arg)
    {
        $this->created = self::toString($arg);
    }

    public function setHash($arg)
    {
        $this->hash = self::toString($arg);
    }

    public function setID($arg)
    {
        $this->id = self::toInt($arg);
    }

    public function setImages($arg)
    {
        $this->images = SystemImage::createArray($arg);
    }

    public function setModified($arg)
    {
        $this->modified = self::toString($arg);
    }

    public function setSourceID($arg)
    {
        $this->source_id = self::toInt($arg);
    }

    public function setSourceProductCode($arg)
    {
        $this->source_product_code = self::toString($arg);
    }

    public function setVariants($arg)
    {
        $this->variants = SystemVariant::createArray($arg);
    }

    public function getChannels()
    {
        return $this->channels;
    }

    public function getClientID()
    {
        return $this->client_id;
    }

    public function getCreated()
    {
        return $this->created;
    }

    public function getHash()
    {
        return $this->hash;
    }

    public function getID()
    {
        return $this->id;
    }

    public function getImages()
    {
        return $this->images;
    }

    public function getModified()
    {
        return $this->modified;
    }

    public function getSourceID()
    {
        return $this->source_id;
    }

    public function getSourceProductCode()
    {
        return $this->source_product_code;
    }

    public function getVariants(): array
    {
        return $this->variants;
    }

    /**
     * sort array properties of Product
     */
    public function sort()
    {
        $this->sortArray($this->images, "id");
    }

    /**
     * @return string
     */
    public function computeHash(): string
    {
        $productHash = parent::computeHash();
        $this->sort();
        $productHash .= "\nsource_product_code=$this->source_product_code";
        foreach ($this->images as $i) {
            $productHash .= "\nimage_$i->id=" . $i->src;
        }
        return md5($productHash);
    }

}
