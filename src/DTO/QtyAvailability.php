<?php
declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

class QtyAvailability extends DTO
{
    public readonly ?string $description;
    public readonly ?float $qty;

    function __construct(array $data)
    {
        $this->description = self::stringFrom($data, "description");
        $this->qty         = self::intFrom($data, "qty");
    }
}
