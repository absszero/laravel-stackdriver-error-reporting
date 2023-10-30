<?php

use Exception;
use Absszero\ErrorReporting;
use PHPUnit\Framework\TestCase;

class ErrorReportingTest extends TestCase
{
    public static $config = [
        'enable' => true,
        'logName' => 'error',
        'serviceId' => 'some_id',
        'versionId' => null,
        'LoggingClient' => [
            'projectId' =>  'projectId',
            'keyFilePath' => null,
            'requestTimeout' => 0,
            'retries' => 3,
            'transport' => null
        ],
        'PsrLogger' => [
            'batchEnabled' => true,
            'debugOutput' => false,
            'batchOptions' => ['numWorkers' => 2],
        ]
    ];

    public function testReport()
    {
        if (! function_exists('config')) {
            function config($key = null)
            {
                return \Illuminate\Support\Arr::get(['error_reporting' => ErrorReportingTest::$config], $key);
            }
        }

        $errorReporting = new ErrorReporting;
        $errorReporting->setReportCallable([$this, 'mockReportCallable']);
        $errorReporting->report(new Exception('test'));
    }

    public function mockReportCallable($exception)
    {
        $this->assertInstanceOf('Exception', $exception);
    }
}
