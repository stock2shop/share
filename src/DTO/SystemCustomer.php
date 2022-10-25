<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

use JsonSerializable;

class SystemCustomer extends Customer implements JsonSerializable, DTOInterface
{
    public ?bool $active;
    /** @var Address[] $addresses */
    public array $addresses;
    public ?string $channel_customer_code;
    public ?int $channel_id;
    public ?int $client_id;
    public ?string $created;
    public ?int $customer_id;
    /** @var OrderMeta[] $meta */
    public array $meta;
    public ?string $modified;
    public User $user;

    public function __construct(array $data)
    {
        parent::__construct($data);

        $addresses = Address::createArray(self::arrayFrom($data, 'addresses'));
        $meta      = OrderMeta::createArray(self::arrayFrom($data, 'meta'));

        $this->active                = self::boolFrom($data, 'active');
        $this->addresses             = $this->sortArray($addresses, 'address_code');
        $this->channel_customer_code = self::stringFrom($data, 'channel_customer_code');
        $this->channel_id            = self::intFrom($data, 'channel_id');
        $this->client_id             = self::intFrom($data, 'client_id');
        $this->created               = self::stringFrom($data, 'created');
        $this->customer_id           = self::intFrom($data, "customer_id");
        $this->meta                  = $this->sortArray($meta, 'key');
        $this->modified              = self::stringFrom($data, 'modified');
        $this->user                  = new User(self::arrayFrom($data, 'user'));
    }

    public static function createFromJSON(string $json): SystemCustomer
    {
        $data = json_decode($json, true);
        return new SystemCustomer($data);
    }

    public function jsonSerialize(): array
    {
        return (array)$this;
    }

    /**
     * @return SystemCustomer[]
     */
    public static function createArray(array $data): array
    {
        $a = [];
        foreach ($data as $item) {
            $a[] = new SystemCustomer((array)$item);
        }
        return $a;
    }
}
