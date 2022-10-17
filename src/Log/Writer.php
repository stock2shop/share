<?php

declare(strict_types=1);

namespace Stock2Shop\Share\Log;

use Aws\CloudWatchLogs\CloudWatchLogsClient;
use InvalidArgumentException;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Maxbanton\Cwh\Handler\CloudWatch;
use Stock2Shop\Share\Config;
use Stock2Shop\Share\Utils\Date;

class Writer
{
    private Logger $logger;

    public function __construct(Config\Conf $conf)
    {
        $this->logger = new Logger($conf->get('LOG_CHANNEL'));
        if (
            $conf->has('LOG_CW_KEY') &&
            $conf->has('LOG_CW_SECRET')
        ) {
            // CloudWatch
            $handler   = $this->handlerCloudWatch($conf);
            $formatter = new JsonFormatter();
            $handler->setFormatter($formatter);
        } else {
            if (
                $conf->has('LOG_FS_DIR') &&
                $conf->has('LOG_FS_FILE_NAME')
            ) {
                // Log to file
                $handler = $this->handlerFile($conf);
            }
        }
        if (!isset($handler)) {
            throw new InvalidArgumentException('Logging not configured');
        }
    }

    /**
     * @param Context[] $context
     */
    public function write(int $level, string $message, array $context): void
    {
        $this->logger->addRecord($level, $message, $context);
    }

    private function handlerCloudWatch(Config\Conf $conf): CloudWatch
    {
        $client = new CloudWatchLogsClient([
            'version'     => $conf->get('LOG_CW_VERSION'),
            'region'      => $conf->get('LOG_CW_VERSION'),
            'credentials' => [
                'key'    => $conf->get('LOG_CW_KEY'),
                'secret' => $conf->get('LOG_CW_SECRET')
            ]
        ]);
        return new CloudWatch(
            $client,
            $conf->get('LOG_CW_GROUP_NAME'),
            substr(Date::getDate(), 0, 10),
            $conf->get('LOG_CW_RETENTION_DAYS'),
            $conf->get('LOG_CW_BATCH_SIZE')
        );
    }

    private function handlerFile(Config\Conf $conf): StreamHandler
    {
        $dir  = $conf->get('LOG_FS_DIR');
        $file = $conf->get('LOG_FS_FILE_NAME');
        if (!file_exists($dir)) {
            mkdir($dir);
        }
        return new StreamHandler($dir . $file);
    }


}