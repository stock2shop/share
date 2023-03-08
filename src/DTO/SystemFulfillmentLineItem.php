<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

use JsonSerializable;

/**
 * @psalm-type TypeSystemFulfillmentLineItem = array{
 *     created?: string|null,
 *     modified?: string|null,
 *     grams?: int|null,
 *     qty?: int|null,
 *     sku?: string|null,
 *     fulfilled_qty?: int|null
 * }
 */
class SystemFulfillmentLineItem extends FulfillmentLineItem implements JsonSerializable, DTOInterface
{
    public ?string $created;
    public ?string $modified;

    /**
     * @param TypeSystemFulfillmentLineItem $data
     */
    public function __construct(array $data)
    {
        /** @psalm-suppress InvalidArgument */
        parent::__construct($data);

        $this->created    = self::stringFrom($data, 'created');
        $this->modified   = self::stringFrom($data, 'modified');
    }

    public function jsonSerialize(): array
    {
        return (array)$this;
    }

    public static function createFromJSON(string $json): SystemFulfillmentLineItem
    {
        $data = json_decode($json, true);
        return new SystemFulfillmentLineItem($data);
    }

    /**
     * @return SystemFulfillmentLineItem[]
     */
    public static function createArray(array $data): array
    {
        $a = [];
        foreach ($data as $item) {
            $a[] = new SystemFulfillmentLineItem((array)$item);
        }
        return $a;
    }
}
