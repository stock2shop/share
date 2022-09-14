<?php
declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

class Channel extends DTO
{

    protected ?bool $active;
    protected ?int $client_id;
    protected ?string $created;
    protected ?string $description;
    protected ?int $id;
    /** @var Meta[] $meta */
    protected array $meta;
    protected ?string $modified;
    protected ?string $price_tier;
    protected ?string $qty_availability;
    protected ?string $sync_token;
    protected ?string $type;

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

    public function setActive($arg): void
    {
        $this->active = self::toBool($arg);
    }

    public function setClientID($arg): void
    {
        $this->client_id = self::toInt($arg);
    }

    public function setCreated($arg): void
    {
        $this->created = self::toString($arg);
    }

    public function setDescription($arg): void
    {
        $this->description = self::toString($arg);
    }

    public function setID($arg): void
    {
        $this->id = self::toInt($arg);
    }

    public function setMeta($arg): void
    {
        $this->meta = Meta::createArray($arg);
    }

    public function setModified($arg): void
    {
        $this->modified = self::toString($arg);
    }

    public function setPriceTier($arg): void
    {
        $this->price_tier = self::toString($arg);
    }

    public function setQtyAvailability($arg): void
    {
        $this->qty_availability = self::toString($arg);
    }

    public function setSyncToken($arg): void
    {
        $this->sync_token = self::toString($arg);
    }

    public function setType($arg): void
    {
        $this->type = self::toString($arg);
    }

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function getClientID(): ?int
    {
        return $this->client_id;
    }

    public function getCreated(): ?string
    {
        return $this->created;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getID(): ?int
    {
        return $this->id;
    }

    public function getMeta(): array
    {
        return $this->meta;
    }

    public function getModified(): ?string
    {
        return $this->modified;
    }

    public function getPriceTier(): ?string
    {
        return $this->price_tier;
    }

    public function getQtyAvailability(): ?string
    {
        return $this->qty_availability;
    }

    public function getSyncToken(): ?string
    {
        return $this->sync_token;
    }

    public function getType(): ?string
    {
        return $this->type;
    }
}
