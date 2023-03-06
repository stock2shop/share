<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

use JsonSerializable;

/**
 * @psalm-import-type TypeCustomer from Customer
 * @psalm-type TypeChannelOrderCustomer = array{
 *     channel_customer_code?: string
 * }
 */
class ChannelOrderCustomer extends Customer implements JsonSerializable, DTOInterface
{
    /**
     * @param TypeChannelOrderCustomer $channel_customer_code
     */
    public ?string $channel_customer_code;

    /**
     * @param TypeCustomer $data
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->channel_customer_code = self::stringFrom($data, 'channel_customer_code');
    }

    public function jsonSerialize(): array
    {
        return (array)$this;
    }

    public static function createFromJSON(string $json): ChannelOrderCustomer
    {
        $data = json_decode($json, true);
        return new ChannelOrderCustomer($data);
    }

    /**
     * @return ChannelOrderCustomer[]
     */
    public static function createArray(array $data): array
    {
        $a = [];
        foreach ($data as $item) {
            $a[] = new ChannelOrderCustomer((array)$item);
        }
        return $a;
    }
}
