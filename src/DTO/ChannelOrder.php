<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

/**
 * @psalm-import-type TypeChannelOrderCustomer from ChannelOrderCustomer
 * @psalm-import-type TypeChannelOrderShippingLine from ChannelOrderShippingLine
 * @psalm-import-type TypeChannelOrderItem from ChannelOrderItem
 * @psalm-import-type TypeAddress from Address
 * @psalm-import-type TypeMeta from Meta
 * @psalm-type TypeChannelOrder = array{
 *     billing_address?: TypeAddress|ChannelOrderAddress,
 *     channel_id?: int|null,
 *     channel_order_code?: string|null,
 *     customer?: TypeChannelOrderCustomer,
 *     instruction?: string|null,
 *     line_items?: array<int, TypeChannelOrderItem>|array<int, ChannelOrderItem>,
 *     meta?: array<int, TypeMeta>|array<int, Meta>,
 *     notes?: string|null,
 *     ordered_date?: string|null,
 *     params?: array<string, string>,
 *     shipping_address?: TypeAddress|ChannelOrderAddress,
 *     shipping_lines?: array<int, TypeChannelOrderShippingLine>|array<int, ChannelOrderShippingLine>,
 *     total_discount?: float|null
 * }
 */
class ChannelOrder extends Order
{
    /**
     * send order to source/ERP
     */
    public const INSTRUCTION_ADD = 'add_order';
    /**
     * Missing instructions, synonymous to "sync_order"
     */
    public const INSTRUCTION_MISSING = '';
    /**
     *  Order edited manually, only allowed if state is "saved"
     */
    public const INSTRUCTION_SYSTEM = 'system';
    /**
     * Payment confirmed with gateway. This is a S2S trade store feature
     */
    public const INSTRUCTION_PROVISIONALLY_PAID = 'provisionally_paid';
    /**
     * Awaiting payment gateway confirmation. This is a S2S trade store feature
     */
    public const INSTRUCTION_UNPAID = 'unpaid_order';
    /**
     * Save Order to s2s, no further processing (i.e. does not get added to source/ERP)
     */
    public const INSTRUCTION_SYNC = 'sync_order';

    /**
     * Reset order back to saved state
     */
    public const INSTRUCTION_RESET = 'reset_order';

    public const ALLOWED_INSTRUCTIONS = [
        self::INSTRUCTION_ADD,
        self::INSTRUCTION_MISSING,
        self::INSTRUCTION_SYSTEM,
        self::INSTRUCTION_PROVISIONALLY_PAID,
        self::INSTRUCTION_UNPAID,
        self::INSTRUCTION_SYNC,
        self::INSTRUCTION_RESET
    ];

    public Address $billing_address;
    public ChannelOrderCustomer $customer;
    public ?string $instruction;
    /** @var ChannelOrderItem[] */
    public array $line_items;
    /** @var OrderMeta[] */
    public array $meta;
    /** @var array<string, string> */
    public array $params;
    public Address $shipping_address;
    /** @var ChannelOrderShippingLine[] */
    public array $shipping_lines;

    /**
     * @param TypeChannelOrder $data
     */
    public function __construct(array $data)
    {
        /** @psalm-suppress InvalidArgument */
        parent::__construct($data);

        $line_items     = ChannelOrderItem::createArray(self::arrayFrom($data, 'line_items'));
        $meta           = OrderMeta::createArray(self::arrayFrom($data, 'meta'));
        $params         = self::arrayFrom($data, 'params');
        $shipping_lines = ChannelOrderShippingLine::createArray(self::arrayFrom($data, 'shipping_lines'));

        // sort params
        ksort($params, SORT_STRING);

        $this->billing_address  = new Address(self::arrayFrom($data, 'billing_address'));
        $this->customer         = new ChannelOrderCustomer(self::arrayFrom($data, 'customer'));
        $this->instruction      = self::stringFrom($data, 'instruction');
        $this->line_items       = $this->sortArray($line_items, 'sku');
        $this->meta             = $this->sortArray($meta, 'key');
        $this->params           = $params;
        $this->shipping_address = new Address(self::arrayFrom($data, 'shipping_address'));
        $this->shipping_lines   = $this->sortArray($shipping_lines, 'title');

        // set instruction to empty if not valid
        if (!in_array($this->instruction, self::ALLOWED_INSTRUCTIONS)) {
            $this->instruction = self::INSTRUCTION_MISSING;
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
