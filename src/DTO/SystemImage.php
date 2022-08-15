<?php

namespace Stock2Shop\Share\DTO;

class SystemImage extends Image
{

    /** @var int $id */
    public $id;

    /** @var bool $active */
    public $active;

    /**
     * Image constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        parent::__construct($data);
        $this->active = self::boolFrom($data, "active");
        $this->id     = self::intFrom($data, 'id');
    }

    /**
     * @param array $data
     * @return SystemImage[]
     */
    static function createArray(array $data): array
    {
        $a = [];
        foreach ($data as $item) {
            $pmd = new SystemImage((array)$item);
            $a[] = $pmd;
        }
        return $a;
    }
}
