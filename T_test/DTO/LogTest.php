<?php

declare(strict_types=1);

namespace Stock2Shop\Test\Share\DTO;
use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO\Log;

class LogTest extends TestCase
{
    private function setUpArray(): array
    { 
        $array = [
            "channel_id" => null,
            "client_id" => "5",
            "context" => [],
            "created" => null,
            "ip" => null,
            "log_to_es" => true,
            "level" => "error",
            "message" => "message",
            "method" => null,
            "metric" => null,
            "origin" => "origin",
            "remote_addr" => null,
            "request_path" => null,
            "source_id" => null,
            "tags" => [],
            "trace" => [],
            "user_id" => null
        ];
        return $array;
    }

    private function setUpJson(): string
    { 
        $json = '{
            "channel_id": null,
            "client_id": 5,
            "context": [],
            "created": null,
            "ip": null,
            "log_to_es": true,
            "level": "error",
            "message": "message",
            "method": null,
            "metric": null,
            "origin": "origin",
            "remote_addr": null,
            "request_path": null,
            "source_id": null,
            "tags": [],
            "trace": [],
            "user_id": null
        }';
        return $json;
    }
    
    public function testClassConstructor(): void
    { 
        $object = new Log($this->setUpArray());

        $this->assertSame(null, $object->channel_id);
        $this->assertSame(5, $object->client_id);
        $this->assertSame([], $object->context);
        $this->assertSame(null, $object->created);
        $this->assertSame(null, $object->ip);
        $this->assertSame(true, $object->log_to_es);
        $this->assertSame("error", $object->level);
        $this->assertSame("message", $object->message);
        $this->assertSame(null, $object->method);
        $this->assertSame("origin", $object->origin);
        $this->assertSame(null, $object->source_id);
        $this->assertSame([], $object->tags);
        $this->assertSame([], $object->trace);

        $this->assertInstanceOf("Stock2Shop\Share\DTO\Log", $object);

        $object_attributes = [
            "channel_id",
            "client_id",
            "context",
            "created",
            "ip",
            "log_to_es",
            "level",
            "message",           
            "method",
            "metric",
            "origin",
            "remote_addr",
            "request_path",
            "source_id",
            "tags",
            "trace",
            "user_id"
        ];

        for($i = 0; $i < sizeof($object_attributes); ++$i)
        {
            $this->assertObjectHasAttribute($object_attributes[$i], $object);
        }
    }

    // public function testSerialize(): void { }

    public function testJsonConversion(): void
    {
        $json = $this->setUpJson();
        $array = json_encode(Log::createFromJSON($json));

        $this->assertJsonStringEqualsJsonString($json, $array);
    }

    public function testArrayConversion(): void
    { 
        $array = [
            [
                "channel_id" => null,
                "client_id" => 5,
                "context" => [],
                "created" => null,
                "ip" => null,
                "log_to_es" => true,
                "level" => "error",
                "message" => "message",
                "method" => null,
                "metric" => null,
                "origin" => "origin",
                "remote_addr" => null,
                "request_path" => null,
                "source_id" => null,
                "tags" => [],
                "trace" => [],
                "user_id" => null
            ],
            [
                "channel_id" => null,
                "client_id" => 50,
                "context" => [],
                "created" => null,
                "ip" => null,
                "log_to_es" => true,
                "level" => "debug",
                "message" => "Client WEB004 does not exist.",
                "method" => null,
                "metric" => null,
                "origin" => "source",
                "remote_addr" => null,
                "request_path" => null,
                "source_id" => null,
                "tags" => [],
                "trace" => [],
                "user_id" => null
            ]
        ];

        $json = '[{
            "channel_id": null,
            "client_id": 5,
            "context": [],
            "created": null,
            "ip": null,
            "log_to_es": true,
            "level": "error",
            "message": "message",
            "method": null,
            "metric": null,
            "origin": "origin",
            "remote_addr": null,
            "request_path": null,
            "source_id": null,
            "tags": [],
            "trace": [],
            "user_id": null
        }, 
        {
            "channel_id": null,
            "client_id": 50,
            "context": [],
            "created": null,
            "ip": null,
            "log_to_es": true,
            "level": "debug",
            "message": "Client WEB004 does not exist.",
            "method": null,
            "metric": null,
            "origin": "source",
            "remote_addr": null,
            "request_path": null,
            "source_id": null,
            "tags": [],
            "trace": [],
            "user_id": null
        }]';

        $json = json_encode(Log::createArray($array));

        $this->assertJsonStringEqualsJsonString(json_encode($array), $json);
    }
}

?>