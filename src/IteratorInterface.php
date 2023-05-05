<?php

declare(strict_types=1);

namespace Stock2Shop\Share;

use ArrayAccess;
use Countable;
use IteratorAggregate;
use JsonSerializable;

/**
 * @template T
 * @template-extends ArrayAccess<string, T>
 * @template-extends IteratorAggregate<string, T>
 * @template-extends Countable
 * @template-extends JsonSerializable
 */
interface IteratorInterface extends ArrayAccess, IteratorAggregate, Countable, JsonSerializable
{
    /**
     * Sorts iterator values
     * @return void
     */
    public function sort(): void;
}
