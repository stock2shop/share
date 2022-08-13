<?php

namespace stock2shop\share\dto;

class Segment extends BaseAbstract
{
    /** @var string|null $type */
    public $type;

    /** @var string|null $key */
    public $key;

    /** @var string|null $operator */
    public $operator;

    /** @var string|null $value */
    public $value;

    /** @var string|null $owner */
    public $owner;

    /** @var string */
    const TYPE_PRODUCTS = 'products';

    /** @var string */
    const TYPE_CUSTOMERS = 'customers';

    /** @var string */
    const TYPE_ORDERS = 'orders';

    /** @var array allowed segment types */
    const ALLOWED_TYPES = [
        self::TYPE_PRODUCTS,
        self::TYPE_CUSTOMERS,
        self::TYPE_ORDERS
    ];

    /** @var string */
    const OPERATOR_EQUAL = 'equal';

    /** @var string OPERATOR_CONTAINS */
    const OPERATOR_CONTAINS = 'contains';

    /** @var string OPERATOR_NOT_CONTAINS */
    const OPERATOR_NOT_CONTAINS = 'not contains';

    /** @var string */
    const OPERATOR_GREATER_THAN = 'greater than';

    /** @var string */
    const OPERATOR_LESS_THAN = 'less than';

    /** @var string */
    const OPERATOR_LOOKUP = 'lookup';

    /** @var array allowed segment operators */
    const ALLOWED_OPERATORS = [
        self::OPERATOR_EQUAL,
        self::OPERATOR_CONTAINS,
        self::OPERATOR_NOT_CONTAINS,
        self::OPERATOR_GREATER_THAN,
        self::OPERATOR_LESS_THAN,
        self::OPERATOR_LOOKUP
    ];

    /** @var string */
    const OWNER_SOURCE = 'source';

    /** @var string */
    const OWNER_SYSTEM = 'system';

    /** @var array allowed owners */
    const ALLOWED_OWNERS = [
        self::OWNER_SOURCE,
        self::OWNER_SYSTEM
    ];

    /**
     * Segment constructor.
     * @param array $data
     */
    function __construct(array $data)
    {
        $this->type     = self::stringFrom($data, "type");
        $this->operator = self::stringFrom($data, "operator");
        $this->key      = self::stringFrom($data, "key");
        $this->value    = self::stringFrom($data, "value");
        $this->owner    = self::stringFrom($data, "owner");
    }

    /**
     * @param string $type
     * @return bool
     */
    static function isValidType(string $type): bool
    {
        return in_array($type, self::ALLOWED_TYPES);
    }

    /**
     * @param string $operator
     * @return bool
     */
    static function isValidOperator(string $operator): bool
    {
        return in_array($operator, self::ALLOWED_OPERATORS);
    }

    /**
     * @param string $owner
     * @return bool
     */
    static function isValidOwner(string $owner): bool
    {
        return in_array($owner, self::ALLOWED_OWNERS);
    }

    /**
     * Creates an array of Segments
     *
     * @param Segment[] $data
     * @return array
     */
    static function createArray(array $data): array
    {
        $a = [];
        foreach ($data as $item) {
            $pmd = new Segment((array)$item);
            $a[] = $pmd;
        }
        return $a;
    }

}
