<?php

namespace Ang3\Component\Odoo;

use Monolog\Handler\StreamHandler;
use Monolog\Logger as MonologLogger;

class Logger extends MonologLogger
{
    public function __construct()
    {
        parent::__construct('ODOO_API_CLIENT');

        $level = $_ENV['LOG_LEVEL'] ?? null;
        if ($level) {
            try {
                $level = Logger::toMonologLevel(strtoupper($level));
            } catch (\Throwable $th) {
                $level = Logger::DEBUG;
            }

            $this->pushHandler(new StreamHandler('php://stdout', $level));
        }
    }
}
