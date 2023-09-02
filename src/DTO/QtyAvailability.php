<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

/**
 * @psalm-type TypeQtyAvailability = array{
 *     description?: string|null,
 *     qty?: int|null
 * }
 */
class QtyAvailability extends DTO
{
    public ?string $description;
    public ?int $qty;

    /**
     * @param TypeQtyAvailability $data
     */
    public function __construct(array $data)
    {
        $this->description = self::stringFrom($data, "description");
        $this->qty         = self::intFrom($data, "qty");
    }
}
