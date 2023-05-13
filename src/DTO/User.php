<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

/**
 * @psalm-import-type TypeSegment from Segment
 * @psalm-type TypeUser = array{
 *     customer_id?: int|null,
 *     id?: int|null,
 *     price_tier?: string|null,
 *     qty_availability?: string|null,
 *     segments?: array<int, TypeSegment>|array<int, Segment>
 * }
 */
class User extends DTO
{
    public ?int $customer_id;
    public ?int $id;
    /** @var Segment[] $segments */
    public array $segments;
    public ?string $price_tier;
    public ?string $qty_availability;

    /**
     * @param TypeUser $data
     */
    public function __construct(array $data)
    {
        // TODO implement segment sort, multi key
        $segments = Segment::createArray(self::arrayFrom($data, 'segments'));

        $this->customer_id      = self::intFrom($data, 'customer_id');
        $this->id               = self::intFrom($data, 'id');
        $this->segments         = $segments;
        $this->price_tier       = self::stringFrom($data, 'price_tier');
        $this->qty_availability = self::stringFrom($data, 'qty_availability');
    }
}
