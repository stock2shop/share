<?php
declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

class SystemProduct extends Product
{
    /** @var Channel[] $channels */
    protected array     $channels;
    protected ?int      $client_id;
    protected ?string   $created;
    protected ?string   $hash;
    protected ?int      $id;
    /** @var SystemImage[] $images */
    protected array     $images;
    protected ?string   $modified;
    protected ?int      $source_id;
    protected ?string   $source_product_code;
    /** @var SystemVariant[] $variants */
    protected array     $variants;

    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->channels            = Channel::createArray(self::arrayFrom($data, 'channels'));
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

    public function setChannels($arg): void
    {
        $this->channels = Channel::createArray($arg);
    }

    public function setClientID($arg): void
    {
        $this->client_id = self::toInt($arg);
    }

    public function setCreated($arg): void
    {
        $this->created = self::toString($arg);
    }

    public function setHash($arg): void
    {
        $this->hash = self::toString($arg);
    }

    public function setID($arg): void
    {
        $this->id = self::toInt($arg);
    }

    public function setImages($arg): void
    {
        $this->images = SystemImage::createArray($arg);
    }

    public function setModified($arg): void
    {
        $this->modified = self::toString($arg);
    }

    public function setSourceID($arg): void
    {
        $this->source_id = self::toInt($arg);
    }

    public function setSourceProductCode($arg): void
    {
        $this->source_product_code = self::toString($arg);
    }

    public function setVariants($arg): void
    {
        $this->variants = SystemVariant::createArray($arg);
    }

    /** @return Channel[] */
    public function getChannels(): array
    {
        return $this->channels;
    }

    public function getClientID(): ?int
    {
        return $this->client_id;
    }

    public function getCreated(): ?string
    {
        return $this->created;
    }

    public function getHash(): ?string
    {
        return $this->hash;
    }

    public function getID(): ?int
    {
        return $this->id;
    }

    /** @return SystemImage[] */
    public function getImages(): array
    {
        return $this->images;
    }

    public function getModified(): ?string
    {
        return $this->modified;
    }

    public function getSourceID(): ?int
    {
        return $this->source_id;
    }

    public function getSourceProductCode(): ?string
    {
        return $this->source_product_code;
    }

    /** @return SystemVariant[] */
    public function getVariants(): array
    {
        return $this->variants;
    }

    public function sort()
    {
        $this->sortArray($this->images, "id");
    }

    public function computeHash(): string
    {
        $productHash = parent::computeHash();
        $this->sort();
        $productHash .= "\nsource_product_code=$this->source_product_code";
        foreach ($this->images as $i) {
            $id          = $i->getID();
            $productHash .= "\nimage_$id=" . $i->getSrc();
        }
        return md5($productHash);
    }

}
