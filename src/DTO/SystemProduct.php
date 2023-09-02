<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

/**
 * @psalm-import-type TypeChannel from Channel
 * @psalm-import-type TypeSystemImage from SystemImage
 * @psalm-import-type TypeSystemVariant from SystemVariant
 * @psalm-import-type TypeProductOption from ProductOption
 * @psalm-import-type TypeMeta from Meta
 * @psalm-type TypeSystemProduct = array{
 *     active?: bool|null,
 *     body_html?: string|null,
 *     channels?: array<int, TypeChannel>|array<int, Channel>,
 *     client_id?: int|null,
 *     collection?: string|null,
 *     created?: string|null,
 *     hash?: string|null,
 *     id?: int|null,
 *     images?: array<int, TypeSystemImage>|array<int, SystemImage>,
 *     meta?: array<int, TypeMeta>|array<int, Meta>,
 *     modified?: string|null,
 *     options?: array<int, TypeProductOption>|array<int, ProductOption>,
 *     product_type?: string|null,
 *     source_id?: int|null,
 *     source_product_code?: string|null,
 *     tags?: string|null,
 *     title?: string|null,
 *     variants?: array<int, TypeSystemVariant>|array<int, SystemVariant>,
 *     vendor?: string|null
 * }
 */
class SystemProduct extends Product
{
    /** @var Channel[] $channels */
    public array $channels;
    public ?int $client_id;
    public ?string $created;
    public ?string $hash;
    public ?int $id;
    /** @var SystemImage[] $images */
    public array $images;
    public ?string $modified;
    public ?int $source_id;
    public ?string $source_product_code;
    /** @var SystemVariant[] $variants */
    public array $variants;

    /**
     * @param TypeSystemProduct $data
     */
    public function __construct(array $data)
    {
        /** @psalm-suppress InvalidArgument */
        parent::__construct($data);

        $images   = SystemImage::createArray(self::arrayFrom($data, 'images'));
        $variants = SystemVariant::createArray(self::arrayFrom($data, 'variants'));
        $channels = Channel::createArray(self::arrayFrom($data, 'channels'));

        $this->channels            = $this->sortArray($channels, 'id');
        $this->client_id           = self::intFrom($data, 'client_id');
        $this->created             = self::stringFrom($data, 'created');
        $this->hash                = self::stringFrom($data, 'hash');
        $this->id                  = self::intFrom($data, 'id');
        $this->images              = $this->sortArray($images, 'id');
        $this->modified            = self::stringFrom($data, 'modified');
        $this->source_id           = self::intFrom($data, 'source_id');
        $this->source_product_code = self::stringFrom($data, 'source_product_code');
        $this->variants            = $this->sortArray($variants, 'id');
    }

    public function computeHash(): string
    {
        $productHash = parent::computeHash();
        $productHash .= sprintf("\nsource_product_code=%s", $this->source_product_code);
        foreach ($this->images as $i) {
            $productHash .= sprintf("\nimage_%d=%s", $i->id, $i->src);
        }
        return md5($productHash);
    }
}
