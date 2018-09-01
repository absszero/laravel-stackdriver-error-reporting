<?php

namespace Absszero;

use Google\Cloud\ErrorReporting\Bootstrap;
use Google\Cloud\Logging\LoggingClient;

class ErrorReporting
{
    protected $reportCallable = [Bootstrap::class, 'exceptionHandler'];

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

    public function setReportCallable($callable)
    {
        $this->reportCallable = $callable;
    }

    public function report($exception)
    {
        call_user_func($this->reportCallable, $exception);
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
