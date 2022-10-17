<?php

declare(strict_types=1);

namespace Stock2Shop\Share\Config;


class Conf implements ConfInterface
{

    private LoaderInterface $loader;

    public function __construct(LoaderInterface $loader)
    {
        $this->loader = $loader;
        $this->loader->set();
    }

    public function get(string $key): string
    {
        return $this->loader->get($key);
    }

    public function has(string $key): bool
    {
        return $this->loader->has($key);
    }

}
