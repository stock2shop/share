<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

use JsonSerializable;

class OrderParams extends DTO implements JsonSerializable, DTOInterface
{
    /** @var array<string, string> */
    public ?array $params;

    /**
     * OrderParams constructor.
     */
    public function __construct(array $data)
    {
        $this->params = [];

        // first sort keys so that we can order the params
        $keys = [];
        foreach ($data as $key => $value) {
            $keys[] = $key;
        }
        sort($keys);

        foreach ($keys as $toSet) {
            foreach ($data as $key => $value) {
                if ($toSet === $key) {
                    $this->params[$key] = $value;
                }
            }
        }
    }

    public static function createFromJSON(string $json): OrderParams
    {
        $data = json_decode($json, true);
        return new OrderParams($data);
    }

    public function jsonSerialize(): array
    {
        return (array) $this->params;
    }

    /**
     * @return OrderParams[]
     */
    public static function createArray(array $data): array
    {
        $a = [];
        foreach ($data as $item) {
            $a[] = new OrderParams((array)$item);
        }
        return $a;
    }
}
