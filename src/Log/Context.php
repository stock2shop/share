<?php

namespace Stock2Shop\Share\Log;

class Context
{
    public string $origin;
    public bool $log_to_es;
    public ?array $stack;
    public ?array $trace;
    public ?array $tags;
    public ?string $metric_key;
    public ?string $metric_value;
    public ?int $channel_id;
    public ?int $source_id;
    public ?int $client_id;
    public ?int $user_id;
    public ?string $ip;
    public ?string $remote_addr;
    public ?string $request_path;
    public ?string $method;

    public function __construct($data)
    {
        // TODO assign vars
    }

    /**
     * @param Context[] $contexts
     */
    public static function toArray(array $contexts): array
    {
        // TODO, remove missing values
        return (array)$contexts;
    }

}
