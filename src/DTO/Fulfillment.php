<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

/**
 * @psalm-type TypeFulfillment = array{
 *     fulfillmentservice_order_code?: string|null,
 *     notes?: string|null,
 *     status?: string|null,
 *     tracking_company?: string|null,
 *     tracking_number?: string|null,
 *     tracking_url?: string|null
 * }
 */
class Fulfillment extends DTO
{
    public ?string $fulfillmentservice_order_code;
    public ?string $notes;
    public ?string $state;
    public ?string $status;
    public ?string $tracking_company;
    public ?string $tracking_number;
    public ?string $tracking_url;

    /**
     * @param TypeFulfillment $data
     */
    public function __construct(array $data)
    {
        $this->fulfillmentservice_order_code = self::stringFrom($data, 'fulfillmentservice_order_code');
        $this->notes                         = self::stringFrom($data, 'notes');
        $this->state                         = self::stringFrom($data, 'state');
        $this->status                        = self::stringFrom($data, 'status');
        $this->tracking_company              = self::stringFrom($data, 'tracking_company');
        $this->tracking_number               = self::stringFrom($data, 'tracking_number');
        $this->tracking_url                  = self::stringFrom($data, 'tracking_url');
    }

    /**
     * Method used by state machine
     * @return string|null
     */
    public function getState(): ?string
    {
        return $this->state;
    }

    /**
     * Method used by state machine
     * @param string|null $state
     * @return void
     */
    public function setState(?string $state): void
    {
        $this->state = $state;
    }
}
