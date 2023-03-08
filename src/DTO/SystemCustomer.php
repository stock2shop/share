<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

use JsonSerializable;

/**
 * @psalm-import-type TypeAddress from Address
 * @psalm-import-type TypeMeta from Meta
 * @psalm-import-type TypeUser from User
 * @psalm-type TypeSystemCustomer = array{
 *     accepts_marketing?: bool|null,
 *     active?: bool|null,
 *     addresses: TypeAddress,
 *     channel_customer_code?: string|null,
 *     channel_id?: int|null,
 *     client_id?: int|null,
 *     created?: string|null,
 *     customer_id?: int|null,
 *     email?: string|null,
 *     first_name?: string|null,
 *     id?: int|null,
 *     last_name?: string|null,
 *     meta: TypeMeta,
 *     modified?: string|null,
 *     user: TypeUser
 * }
 */
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
    public ?int $id;
    /** @var Meta[] $meta */
    public array $meta;
    public ?string $modified;
    public User $user;

    public function __construct(array $data)
    {
        parent::__construct($data);

        $addresses = Address::createArray(self::arrayFrom($data, 'addresses'));
        $meta      = Meta::createArray(self::arrayFrom($data, 'meta'));

        $this->active                = self::boolFrom($data, 'active');
        $this->addresses             = $this->sortArray($addresses, 'address_code');
        $this->channel_customer_code = self::stringFrom($data, 'channel_customer_code');
        $this->channel_id            = self::intFrom($data, 'channel_id');
        $this->client_id             = self::intFrom($data, 'client_id');
        $this->created               = self::stringFrom($data, 'created');
        $this->customer_id           = self::intFrom($data, "customer_id");
        $this->id                    = self::intFrom($data, "id");
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
