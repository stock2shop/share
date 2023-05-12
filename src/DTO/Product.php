<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

use Stock2Shop\Share\DTO\Maps\Metas;

/**
 * @psalm-import-type TypeProductOption from ProductOption
 * @psalm-import-type TypeMeta from Meta
 * @psalm-type TypeProduct = array{
 *     active?: bool|null,
 *     body_html?: string|null,
 *     collection?: string|null,
 *     meta?: array<int, TypeMeta>|array<int, Meta>,
 *     options?: array<int, TypeProductOption>|array<int, ProductOption>,
 *     product_type?: string|null,
 *     tags?: string|null,
 *     title?: string|null,
 *     vendor?: string|null
 * }
 */
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
    /** @var Metas $meta */
    public Metas $meta;

    /**
     * @param TypeProduct $data
     */
    public function __construct(array $data)
    {
        $options = ProductOption::createArray(self::arrayFrom($data, "options"));
        $tags    = self::stringFrom($data, "tags");

        $this->active       = self::boolFrom($data, "active");
        $this->title        = self::stringFrom($data, "title");
        $this->body_html    = self::stringFrom($data, "body_html");
        $this->collection   = self::stringFrom($data, "collection");
        $this->product_type = self::stringFrom($data, "product_type");
        $this->tags         = $this->sortCSV($tags);
        $this->vendor       = self::stringFrom($data, "vendor");
        $this->options      = $this->sortArray($options, "name");
        $this->meta         = new Metas(self::arrayFrom($data, "meta"));
    }

    public function computeHash(): string
    {
        $p    = new Product($this->toArray());
        $json = json_encode($p);
        return md5($json);
    }

    public static function createFromJSON(string $json): Product
    {
        $data = json_decode($json, true);
        return new Product($data);
    }

    /**
     * @return Product[]
     */
    public static function createArray(array $data): array
    {
        $a = [];
        foreach ($data as $item) {
            $a[] = new Product((array)$item);
        }
        return $a;
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    public function toArray(): array {
        $meta = $this->meta->toArray();
        $arr = (array)$this;
        $arr['meta'] = $meta;
        return $arr;
    }
}
