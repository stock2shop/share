<?php

namespace Stock2Shop\Share\DTO;

class Product extends AbstractBase
{
    /** @var bool|null $active */
    protected $active;

    /** @var string|null $title */
    protected $title;

    /** @var string|null $body */
    protected $body_html;

    /** @var string|null $collection */
    protected $collection;

    /** @var string|null $productType */
    protected $product_type;

    /** @var string|null $tags */
    protected $tags;

    /** @var string|null $vendor */
    protected $vendor;

    /** @var ProductOption[] $options */
    protected $options;

    /** @var Meta[] $meta */
    protected $meta;

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

    public function setActive($arg)
    {
        $this->active = self::toBool($arg);
    }

    public function setTitle($arg)
    {
        $this->title = self::toString($arg);
    }

    public function setBodyHtml($arg)
    {
        $this->body_html = self::toBString($arg);
    }

    public function setCollection($arg)
    {
        $this->collection = self::toString($arg);
    }

    public function setProductType($arg)
    {
        $this->product_type = self::toString($arg);
    }

    public function setTags($arg)
    {
        $this->tags = self::toString($arg);
    }

    public function setVendor($arg)
    {
        $this->vendor = self::toString($arg);
    }

    public function setOptions($arg)
    {
        $this->options = ProductOption::createArray($arg);
    }

    public function setMeta($arg)
    {
        $this->meta = Meta::createArray($arg);
    }

    public function getActive()
    {
        return $this->active;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getBodyHtml()
    {
        return $this->body_html;
    }

    public function getCollection()
    {
        return $this->collection;
    }

    public function getProductType()
    {
        return $this->product_type;
    }

    public function getTags()
    {
        return $this->tags;
    }

    public function getVendor()
    {
        return $this->vendor;
    }

    public function getOptions()
    {
        return $this->options;
    }

    public function getMeta()
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

    /**
     * @return string
     */
    public function computeHash(): string
    {
        $p = new Product((array)$this);
        $p->sort();
        $json = json_encode($p);

        return md5($json);
    }
}
