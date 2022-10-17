<?php

declare(strict_types=1);

namespace Stock2Shop\Share\Config;

use OutOfBoundsException;

interface LoaderInterface
{
    /**
     * Sets all config
     */
    public function set(): void;

    /**
     * Returns single config by key
     * @throws OutOfBoundsException
     */
    public function get(string $key): string;

    /**
     * See if config exists (not blank)
     */
    public function has(string $key): bool;

}
