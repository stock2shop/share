<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO\Maps;

use Stock2Shop\Share\DTO\Meta;
use Stock2Shop\Share\Map;

/**
 * @extends Map<string, Meta>
 * @psalm-import-type TypeMeta from Meta
 */
class Metas extends Map
{

    const KEY = 'key';

    public function __construct(array $data)
    {
        /** @var array<int, Meta> $meta */
        $meta = [];
        if(!empty($data)) {
            if($data[0] instanceof Meta) {
                $meta = $data;
            } else {
                foreach ($data as $m) {
                    $meta[] = new Meta($m);
                }
            }
        }
        parent::__construct($meta, self::KEY);
    }
}
