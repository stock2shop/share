<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

use JsonSerializable;
use Stock2Shop\Share\Utils\Date;

class Log extends DTO implements JsonSerializable, DTOInterface
{
    public const LOG_LEVEL_ERROR = 'error';
    public const LOG_LEVEL_DEBUG = 'debug';
    public const LOG_LEVEL_INFO = 'info';
    public const LOG_LEVEL_CRITICAL = 'critical';
    public const LOG_LEVEL_WARNING = 'warning';
    private const ALLOWED_LOG_LEVEL = [
        self::LOG_LEVEL_ERROR,
        self::LOG_LEVEL_DEBUG,
        self::LOG_LEVEL_INFO,
        self::LOG_LEVEL_CRITICAL,
        self::LOG_LEVEL_WARNING
    ];

    public ?int $channel_id;
    public int $client_id;
    public ?array $context;
    public ?string $created;
    public ?string $ip;
    public bool $log_to_es;
    public string $level;
    public string $message;
    public ?string $method;
    public ?float $metric;
    public string $origin;
    public ?string $remote_addr;
    public ?string $request_path;
    public ?int $source_id;
    /** @var string[]|null */
    public ?array $tags;
    /** @var string[]|null */
    public ?array $trace;
    public ?int $user_id;

    public function __construct(array $data)
    {
        $context = LogContext::createArray(self::arrayFrom($data, "context"));

        $this->channel_id   = self::intFrom($data, 'channel_id');
        $this->client_id    = self::intFrom($data, 'client_id');
        $this->context      = $this->sortArray($context, "key");
        $this->created      = self::dateStringFrom($data, 'created', Date::FORMAT_MS);
        $this->ip           = self::stringFrom($data, 'ip');
        $this->log_to_es    = self::boolFrom($data, 'log_to_es');
        $this->level        = self::stringFrom($data, 'level');
        $this->message      = self::stringFrom($data, 'message');
        $this->method       = self::stringFrom($data, 'method');
        $this->metric       = self::floatFrom($data, "metric");
        $this->origin       = self::stringFrom($data, 'origin');
        $this->remote_addr  = self::stringFrom($data, 'remote_addr');
        $this->request_path = self::stringFrom($data, 'request_path');
        $this->source_id    = self::intFrom($data, 'source_id');
        $this->tags         = self::arrayFrom($data, 'tags');
        $this->trace        = self::arrayFrom($data, 'trace');
        $this->user_id      = self::intFrom($data, 'user_id');
        if (!in_array($this->level, self::ALLOWED_LOG_LEVEL)) {
            throw new \InvalidArgumentException(sprintf('Invalid log level %s', $this->level));
        }
    }

    public function jsonSerialize(): array
    {
        return (array)$this;
    }

    public static function createFromJSON(string $json): Log
    {
        $data = json_decode($json, true);
        return new Log($data);
    }

    /**
     * @return Log[]
     */
    public static function createArray(array $data): array
    {
        $a = [];
        foreach ($data as $item) {
            $a[] = new Log((array)$item);
        }
        return $a;
    }
}
