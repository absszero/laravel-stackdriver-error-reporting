<?php

namespace Absszero;

use Google\Cloud\ErrorReporting\Bootstrap;
use Google\Cloud\Logging\LoggingClient;

class ErrorReporting
{
    public function __construct()
    {
        $logName = config('error_reporting.log_name');
        $loggingClient = new LoggingClient(config('error_reporting.LoggingClient'));
        Bootstrap::$psrLogger = $loggingClient->psrLogger($logName, $this->psrLoggerOptions());
    }

    public function report($exception)
    {
        Bootstrap::exceptionHandler($exception);
    }

    protected function psrLoggerOptions()
    {
        $options = config('error_reporting.PsrLogger');
        $metadataProvider = array_get($options, 'metadataProvider');
        if (is_callable($metadataProvider)) {
            $options['metadataProvider'] = $metadataProvider(config('error_reporting'));
        }

        return $options;
    }
}
