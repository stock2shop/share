<?php

namespace Stock2shop\Share\DTO;

/**
 *
 * This is used by many classes.
 * e.g. Customers, Products, Sources, Channels ...
 *
 * Class Meta
 * @package stock2shop\vo
 */
class Meta extends AbstractBase
{

    /** @var string|null $key */
    protected $key;

    /** @var string|null $value */
    protected $value;

    /** @var string|null $template_name */
    protected $template_name;

    /**
     * Meta constructor.
     * @param array $data
     */
    function __construct(array $data)
    {
        $this->key           = self::stringFrom($data, "key");
        $this->value         = self::stringFrom($data, "value");
        $this->template_name = self::stringFrom($data, "template_name");
    }

    public function setKey($arg)
    {
        $this->key = self::toString($arg);
    }

    public function setValue($arg)
    {
        $this->value = self::toString($arg);
    }

    public function setTemplateName($arg)
    {
        $this->template_name = self::toString($arg);
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function getTemplateName(): string
    {
        return $this->template_name;
    }

}