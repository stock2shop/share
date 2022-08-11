<?php

namespace stock2shop\share\vo;

class SourceProductSource extends Base
{
    /** @var int|null $source_id */
    public $source_id;

    /** @var string|null $source_product_code */
    public $source_product_code;

    /** @var bool|null $product_active */
    public $product_active;

    /** @var string|null $sync_token */
    public $sync_token;

    /** @var string|null $fetch_token */
    public $fetch_token;

    /** @var Meta[] $skumeta */
    public $skumeta;

    /**
     * SourceProductSource constructor.
     * @param array $data
     */
    function __construct(array $data)
    {
        $this->source_id           = self::intFrom($data, "source_id");
        $this->source_product_code = self::stringFrom($data, "source_product_code");
        $this->product_active      = self::boolFrom($data, "product_active");
        $this->sync_token          = self::stringFrom($data, "sync_token");
        $this->fetch_token         = self::stringFrom($data, "fetch_token");
        $this->skumeta             = self::arrayFrom($data, "skumeta");
    }

}
