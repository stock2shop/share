<?php
declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

class Image extends  DTO
{
    protected ?string $src;

    public function __construct(array $data)
    {
        $this->src = self::stringFrom($data, 'src');
    }

    public function setSrc($arg): void
    {
        $this->src = self::toString($arg);
    }

    public function getSrc(): ?string
    {
        return $this->src;
    }
}
