<?php
declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

class Image extends  DTO
{
    public ?string $src;

    public function __construct(array $data)
    {
        $this->src = self::stringFrom($data, 'src');
    }
}
