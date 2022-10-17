<?php

declare(strict_types=1);

namespace Stock2Shop\Share\Config;

use Dotenv\Dotenv;
use OutOfBoundsException;

class LoaderDotenv implements LoaderInterface
{

    private string $env_path;

    public function __construct(string $env_path)
    {
        $this->env_path = $env_path;
    }

    public function set(): void
    {
        $dotenv = Dotenv::createImmutable($this->env_path);
        $dotenv->load();
    }

    public function get(string $key): string
    {
        if (!isset($_SERVER[$key])) {
            throw new OutOfBoundsException(sprintf('Missing Config `%s`', $key));
        }
        return $_SERVER[$key];
    }

    public function has(string $key): bool
    {
        return (isset($_SERVER[$key]) && $_SERVER[$key] !== '');
    }

}
