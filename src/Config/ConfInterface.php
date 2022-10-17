<?php

declare(strict_types=1);

namespace Stock2Shop\Share\Config;

use OutOfBoundsException;

interface ConfInterface
{

    /**
     * @throws OutOfBoundsException
     */
    public function get(string $key): string;

    public function has(string $key): bool;

}
