<?php
declare(strict_types=1);

namespace Stock2shop\Share\DTO;

/**
 *
 * This is used by many classes.
 * e.g. Customers, Products, Sources, Channels ...
 *
 * Class Meta
 * @package stock2shop\vo
 */
class Meta extends DTO
{
    protected ?string $key;
    protected ?string $value;
    protected ?string $template_name;

    /**
     * Meta constructor.
     */
    function __construct(array $data)
    {
        $this->key           = self::stringFrom($data, "key");
        $this->value         = self::stringFrom($data, "value");
        $this->template_name = self::stringFrom($data, "template_name");
    }

    public function setKey($arg): void
    {
        $this->key = self::toString($arg);
    }

    public function setValue($arg): void
    {
        $this->value = self::toString($arg);
    }

    public function setTemplateName($arg): void
    {
        $this->template_name = self::toString($arg);
    }

    public function getKey(): ?string
    {
        return $this->key;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function getTemplateName(): ?string
    {
        return $this->template_name;
    }

}
