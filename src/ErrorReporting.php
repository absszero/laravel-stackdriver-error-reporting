<?php

namespace Absszero;

use Google\Cloud\ErrorReporting\Bootstrap;
use Google\Cloud\Logging\LoggingClient;

class ErrorReporting
{
    public function __construct($metadataProvider = null)
    {
        $logName = config('error_reporting.log_name');
        $loggingClient = new LoggingClient(config('error_reporting.LoggingClient'));

        $options = config('error_reporting.PsrLogger');
        if (is_null($metadataProvider)) {
            $metadataProvider = $this->setCustomMetadataProvider(config('error_reporting'));
        }
        $options['metadataProvider'] = $metadataProvider;

        Bootstrap::$psrLogger = $loggingClient->psrLogger($logName, $options);
    }

    public function report($exception)
    {
        Bootstrap::exceptionHandler($exception);
    }

    protected function setCustomMetadataProvider($config)
    {
        return new MetadataProvider(
            $config['LoggingClient']['projectId'],
            $config['serviceId'],
            $config['versionId']
        );
    }
}
