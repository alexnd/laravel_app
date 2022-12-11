<?php

namespace App\Services;

use Psr\Log\LoggerInterface;

class BaseService
{
    protected LoggerInterface $logger;

    public function __construct() {
        $this->logger = resolve(LoggerInterface::class);
    }

    public function log(string $msg): void
    {
        $this->logger->debug($msg);
    }

    public function logError(string $msg): void
    {
        $this->logger->error($msg);
    }

    public function logCritical(string $msg): void
    {
        $this->logger->critical($msg);
    }
}
