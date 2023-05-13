<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

use Stock2Shop\Share\Map;

/**
 * @psalm-import-type TypeMeta from Meta
 * @psalm-type TypeFulfillmentService = array{
 *     active?: bool|null,
 *     client_id?: int|null,
 *     created?: string|null,
 *     description?: string|null,
 *     id?: int|null,
 *     meta?: array<int, TypeMeta>,
 *     modified?: string|null,
 *     is_warehouse?: bool|null
 * }
 */
class FulfillmentService extends DTO
{
    public ?bool $active;
    public ?int $client_id;
    public ?string $created;
    public ?string $description;
    public ?int $id;
    public ?bool $is_warehouse;
    /** @var Map<string, Meta> $meta */
    public Map $meta;
    public ?string $modified;
    public ?string $type;

    /**
     * @param TypeFulfillmentService $data
     */
    public function __construct(array $data)
    {
        $this->active       = self::boolFrom($data, 'active');
        $this->client_id    = self::intFrom($data, 'client_id');
        $this->created      = self::stringFrom($data, 'created');
        $this->description  = self::stringFrom($data, 'description');
        $this->id           = self::intFrom($data, 'id');
        $this->is_warehouse = self::boolFrom($data, 'is_warehouse');
        $this->meta         = new Map(
            Meta::createArray(self::arrayFrom($data, 'meta')),
            'key'
        );
        $this->modified     = self::stringFrom($data, 'modified');
        $this->type         = self::stringFrom($data, 'type');
    }
}
