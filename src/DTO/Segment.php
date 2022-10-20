<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

use JsonSerializable;

class Segment extends DTO implements JsonSerializable, DTOInterface
{
    public const TYPE_PRODUCTS = 'products';
    public const TYPE_CUSTOMERS = 'customers';
    public const TYPE_ORDERS = 'orders';
    public const ALLOWED_TYPES = [
        self::TYPE_PRODUCTS,
        self::TYPE_CUSTOMERS,
        self::TYPE_ORDERS
    ];
    public const OPERATOR_EQUAL = 'equal';
    public const OPERATOR_CONTAINS = 'contains';
    public const OPERATOR_NOT_CONTAINS = 'not contains';
    public const OPERATOR_GREATER_THAN = 'greater than';
    public const OPERATOR_LESS_THAN = 'less than';
    public const OPERATOR_LOOKUP = 'lookup';
    public const ALLOWED_OPERATORS = [
        self::OPERATOR_EQUAL,
        self::OPERATOR_CONTAINS,
        self::OPERATOR_NOT_CONTAINS,
        self::OPERATOR_GREATER_THAN,
        self::OPERATOR_LESS_THAN,
        self::OPERATOR_LOOKUP
    ];
    public const OWNER_SOURCE = 'source';
    public const OWNER_SYSTEM = 'system';
    public const ALLOWED_OWNERS = [
        self::OWNER_SOURCE,
        self::OWNER_SYSTEM
    ];

    public ?string $type;
    public ?string $key;
    public ?string $operator;
    public ?string $value;
    public ?string $owner;


    public function __construct(array $data)
    {
        $this->type     = self::stringFrom($data, 'type');
        $this->key      = self::stringFrom($data, 'key');
        $this->operator = self::stringFrom($data, 'operator');
        $this->value    = self::stringFrom($data, 'value');
        $this->owner    = self::stringFrom($data, 'owner');
    }

    public static function createFromJSON(string $json): Segment
    {
        $data = json_decode($json, true);
        return new Segment($data);
    }

    public function jsonSerialize(): array
    {
        return (array)$this;
    }

    /**
     * @return Segment[]
     */
    public static function createArray(array $data): array
    {
        $a = [];
        foreach ($data as $item) {
            $a[] = new Segment((array)$item);
        }
        return $a;
    }
}
