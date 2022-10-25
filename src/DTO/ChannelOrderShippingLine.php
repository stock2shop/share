<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

use JsonSerializable;

class ChannelOrderShippingLine extends OrderItem implements JsonSerializable, DTOInterface
{
    // TODO must include tax order item tax as "tax_lines"
}
