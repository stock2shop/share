<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

use JsonSerializable;

/**
 * @psalm-type TypeOrderSource = array{
 *     source_id?: int|null,
 *     source_customer_code?: string|null,
 *     source_order_code?: string|null
 * }
 */
class OrderSource extends DTO implements JsonSerializable, DTOInterface
{
    public ?int $source_id;
    public ?string $source_customer_code;
    public ?string $source_order_code;

    /**
     * @param TypeOrderSource $data
     */
    public function __construct(array $data)
    {
        $this->source_id            = self::intFrom($data, "source_id");
        $this->source_customer_code = self::stringFrom($data, "source_customer_code");
        $this->source_order_code    = self::stringFrom($data, "source_order_code");
    }

    public static function createFromJSON(string $json): OrderSource
    {
        $data = json_decode($json, true);
        return new OrderSource($data);
    }

    public function jsonSerialize(): array
    {
        return (array)$this;
    }

    /**
     * @return OrderSource[]
     */
    public static function createArray(array $data): array
    {
        $a = [];
        foreach ($data as $item) {
            $a[] = new OrderSource((array)$item);
        }
        return $a;
    }
}
