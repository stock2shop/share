<?php

declare(strict_types=1);

namespace Stock2Shop\Share;

use ArrayAccess;
use Countable;
use IteratorAggregate;
use JsonSerializable;

/**
 * @template TKey
 * @template TValue
 * @template-extends ArrayAccess<TKey, TValue>
 * @template-extends IteratorAggregate<TKey, TValue>
 * @template-extends Countable
 * @template-extends JsonSerializable
 */
interface IteratorInterface extends ArrayAccess, IteratorAggregate, Countable, JsonSerializable
{
}
