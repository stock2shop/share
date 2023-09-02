<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

/**
 * @psalm-type TypeCustomer = array{
 *     accepts_marketing?: bool|null,
 *     email?: string|null,
 *     first_name?: string|null,
 *     last_name?: string|null
 * }
 */
class Customer extends DTO
{
    public ?bool $accepts_marketing;
    public ?string $email;
    public ?string $first_name;
    public ?string $last_name;

    /**
     * @param TypeCustomer $data
     */
    public function __construct(array $data)
    {
        $this->accepts_marketing = self::boolFrom($data, 'accepts_marketing');
        $this->email             = self::stringFrom($data, 'email');
        $this->first_name        = self::stringFrom($data, 'first_name');
        $this->last_name         = self::stringFrom($data, 'last_name');
    }

    public function computeHash(): string
    {
        $p    = new Customer((array)$this);
        $json = json_encode($p);
        return md5($json);
    }
}
