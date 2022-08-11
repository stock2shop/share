<?php

namespace stock2shop\share\vo;

class Image extends Base
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

    /**
     * Creates an array of this class
     * @param array $data
     * @return ChannelImage[]
     */
    static function createArray(array $data): array
    {
        $a = [];
        foreach ($data as $item) {
            $ci  = new Image((array)$item);
            $a[] = $ci;
        }
        return $a;
    }
}
