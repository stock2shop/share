<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

class Product extends DTO
{
    public ?bool $active;
    public ?string $title;
    public ?string $body_html;
    public ?string $collection;
    public ?string $product_type;
    public ?string $tags;
    public ?string $vendor;
    /** @var ProductOption[] $options */
    public array $options;
    /** @var Meta[] $meta */
    public array $meta;

    function __construct(array $data)
    {
        $options            = ProductOption::createArray(self::arrayFrom($data, "options"));
        $meta               = Meta::createArray(self::arrayFrom($data, "meta"));
        $tags               = self::stringFrom($data, "tags");

        $this->active       = self::boolFrom($data, "active");
        $this->title        = self::stringFrom($data, "title");
        $this->body_html    = self::stringFrom($data, "body_html");
        $this->collection   = self::stringFrom($data, "collection");
        $this->product_type = self::stringFrom($data, "product_type");
        $this->tags         = $this->sortCSV($tags);
        $this->vendor       = self::stringFrom($data, "vendor");
        $this->options      = $this->sortArray($options, "name");
        $this->meta         = $this->sortArray($meta, "key");
    }

    public function computeHash(): string
    {
        $p    = new Product((array)$this);
        $json = json_encode($p);
        return md5($json);
    }
}
