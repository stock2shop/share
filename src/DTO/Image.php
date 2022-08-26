<?php

namespace Stock2Shop\Share\DTO;

class Image extends  AbstractBase
{
    /** @var string|null $src */
    public $src;

    /**
     * Image constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->src = self::stringFrom($data, 'src');
    }
}
