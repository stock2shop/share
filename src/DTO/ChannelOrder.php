<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

use JsonSerializable;

/**
 * @psalm-import-type TypeOrder from Order
 * @psalm-import-type TypeChannelOrderCustomer from ChannelOrderCustomer
 * @psalm-import-type TypeOrderItem from OrderItem
 * @psalm-import-type TypeMeta from Meta
 * @psalm-import-type TypeAddress from Address
 * @psalm-import-type TypeOrderShippingLine from OrderShippingLine
 * @psalm-type TypeChannelOrder = array{
 *     billing_address: TypeAddress,
 *     customer: TypeChannelOrderCustomer,
 *     instruction?: string,
 *     line_items: TypeOrderItem,
 *     meta: TypeMeta,
 *     shipping_address: TypeAddress,
 *     shipping_lines: TypeOrderShippingLine
 * }
 */
class ChannelOrder extends Order implements JsonSerializable, DTOInterface
{
    // order instructions
    public const INSTRUCTION_ADD_ORDER = 'add_order';
    public const INSTRUCTION_EMPTY = '';
    public const INSTRUCTION_UNPAID_ORDER = 'unpaid_order';
    public const ALLOWED_INSTRUCTIONS = [
        self::INSTRUCTION_ADD_ORDER,
        self::INSTRUCTION_EMPTY,
        self::INSTRUCTION_UNPAID_ORDER
    ];

    public ChannelOrderAddress $billing_address;
    public ChannelOrderCustomer $customer;
    public ?string $instruction;
    /** @var ChannelOrderItem[] */
    public array $line_items;
    /** @var OrderMeta[] */
    public array $meta;
    /** @var array<string, string> */
    public array $params;
    public ChannelOrderAddress $shipping_address;
    /** @var ChannelOrderShippingLine[] */
    public array $shipping_lines;

    /**
     * @param TypeChannelOrder $data
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        $line_items     = ChannelOrderItem::createArray(self::arrayFrom($data, 'line_items'));
        $meta           = OrderMeta::createArray(self::arrayFrom($data, 'meta'));
        $params         = self::arrayFrom($data, 'params');
        $shipping_lines = ChannelOrderShippingLine::createArray(self::arrayFrom($data, 'shipping_lines'));

        // sort params
        ksort($params, SORT_STRING);

        $this->billing_address  = new ChannelOrderAddress(self::arrayFrom($data, 'billing_address'));
        $this->customer         = new ChannelOrderCustomer(self::arrayFrom($data, 'customer'));
        $this->instruction      = self::stringFrom($data, 'instruction');
        $this->line_items       = $this->sortArray($line_items, 'sku');
        $this->meta             = $this->sortArray($meta, 'key');
        $this->params           = $params;
        $this->shipping_address = new ChannelOrderAddress(self::arrayFrom($data, 'shipping_address'));
        $this->shipping_lines   = $this->sortArray($shipping_lines, 'title');

        // set instruction to empty if not valid
        if (!in_array($this->instruction, self::ALLOWED_INSTRUCTIONS)) {
            $this->instruction = self::INSTRUCTION_EMPTY;
        }
    }

    /**
     * Computes a hash of the ChannelOrder
     */
    public function computeHash(): string
    {
        $p = new ChannelOrder((array)$this);
        unset($p->instruction);
        $json = json_encode($p);
        return md5($json);
    }

    public function jsonSerialize(): array
    {
        return (array)$this;
    }

    public static function createFromJSON(string $json): ChannelOrder
    {
        $data = json_decode($json, true);
        return new ChannelOrder($data);
    }

    /**
     * @return ChannelOrder[]
     */
    public static function createArray(array $data): array
    {
        $a = [];
        foreach ($data as $item) {
            $a[] = new ChannelOrder((array)$item);
        }
        return $a;
    }
}
