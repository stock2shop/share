<?php
declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

class Product extends DTO
{
    protected ?bool     $active;
    protected ?string   $title;
    protected ?string   $body_html;
    protected ?string   $collection;
    protected ?string   $product_type;
    protected ?string   $tags;
    protected ?string   $vendor;
    /** @var ProductOption[] $options */
    protected array $options;
    /** @var Meta[] $meta */
    protected array $meta;

    function __construct(array $data)
    {
        $this->active       = self::boolFrom($data, "active");
        $this->title        = self::stringFrom($data, "title");
        $this->body_html    = self::stringFrom($data, "body_html");
        $this->collection   = self::stringFrom($data, "collection");
        $this->product_type = self::stringFrom($data, "product_type");
        $this->tags         = self::stringFrom($data, "tags");
        $this->vendor       = self::stringFrom($data, "vendor");
        $this->options      = ProductOption::createArray(self::arrayFrom($data, "options"));
        $this->meta         = Meta::createArray(self::arrayFrom($data, "meta"));
    }

    public function setActive($arg): void
    {
        $this->active = self::toBool($arg);
    }

    public function setTitle($arg): void
    {
        $this->title = self::toString($arg);
    }

    public function setBodyHtml($arg): void
    {
        $this->body_html = self::toString($arg);
    }

    public function setCollection($arg): void
    {
        $this->collection = self::toString($arg);
    }

    public function setProductType($arg): void
    {
        $this->product_type = self::toString($arg);
    }

    public function setTags($arg): void
    {
        $this->tags = self::toString($arg);
    }

    public function setVendor($arg): void
    {
        $this->vendor = self::toString($arg);
    }

    public function setOptions($arg): void
    {
        $this->options = ProductOption::createArray($arg);
    }

    public function setMeta($arg): void
    {
        $this->meta = Meta::createArray($arg);
    }

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function getBodyHtml(): ?string
    {
        return $this->body_html;
    }

    public function getCollection(): ?string
    {
        return $this->collection;
    }

    public function getProductType(): ?string
    {
        return $this->product_type;
    }

    public function getTags(): ?string
    {
        return $this->tags;
    }

    public function getVendor(): ?string
    {
        return $this->vendor;
    }

    /** @return ProductOption[] */
    public function getOptions(): array
    {
        return $this->options;
    }

    /** @return Meta[] */
    public function getMeta(): array
    {
        return $this->meta;
    }

    /**
     * sort array properties of Product
     */
    public function sort()
    {
        $this->sortArray($this->options, "name");
        $this->sortArray($this->meta, "key");
        if (!is_null($this->tags)) {
            $this->sortCSV($this->tags);
        }
    }

    public function computeHash(): string
    {
        $p = new Product((array)$this);
        $p->sort();
        $json = json_encode($p);

        return md5($json);
    }
}
