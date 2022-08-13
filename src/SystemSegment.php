<?php

namespace Stock2Shop\DTO;

class SystemSegment extends Segment
{
    /** @var int|null $id */
    public $id;

    /** @var int|null $user_id */
    public $user_id;

    /** @var int|null $client_id */
    public $client_id;

    /**
     * SystemSegment constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->id        = static::intFrom($data, 'id');
        $this->user_id   = static::intFrom($data, 'user_id');
        $this->client_id = static::intFrom($data, 'client_id');
    }

    /**
     * @param array $data
     * @return SystemSegment[]
     */
    static function createArray(array $data): array {
        $a = [];
        foreach ($data as $item) {
            $pmd = new SystemSegment((array)$item);
            $a[] = $pmd;
        }
        return $a;
    }
}
