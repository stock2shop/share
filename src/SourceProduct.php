<?php

namespace Stock2Shop\DTO;

class SourceProduct extends BaseAbstract
{
    /** @var SourceProductSource $source */
    public $source;

    /** @var SourceProductProduct $product */
    public $product;

    /**
     * SourceProduct constructor.
     * @param array $data
     */
    function __construct(array $data)
    {
        $this->source  = new SourceProductSource(self::arrayFrom($data, "source"));
        $this->product = new SourceProductProduct(self::arrayFrom($data, "product"));
    }

    /**
     * @return string
     */
    public function computeHash(): string
    {
        $productHash = $this->product->computeHash();
        $variantHash = $this->product->variants->computeHash();

        $this->product->sort();

        // More properties to include in the hash?
        // Order is important.
        // DO NOT include Stock2Shop DB IDs,
        // auto-increment PK might be replaced by KSUID
        $productHash    .= "\n" . $variantHash;
        $productHash    .= "\nsource_product_code=" . $this->source->source_product_code;
        $product_active = $this->source->product_active ? "1" : "0";
        $productHash    .= "\nproduct_active=" . $product_active;
        $productHash    .= "\nmeta_delete=" . json_encode($this->product->meta_delete);
        return md5($productHash);
    }
}
