<?php

namespace Stock2Shop\Share\DTO;

class Image extends  AbstractBase
{
    /** @var string|null $src */
    protected $src;

    public function __construct(array $data)
    {
        $this->src = self::stringFrom($data, 'src');
    }

    public function setSrc($arg) {
        $this->src = self::toString($arg);
    }

    public function getSrc() {
        return $this->src;
    }
}
