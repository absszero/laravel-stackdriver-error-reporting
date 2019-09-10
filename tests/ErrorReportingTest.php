<?php

use Absszero\ErrorReporting;
use PHPUnit\Framework\TestCase;

class ErrorReportingTest extends TestCase
{
    public static $config = [
        'error_reporting.logName' => 'name',
        'error_reporting.LoggingClient' => [
            'projectId' => 'projectId',
        ],
        'error_reporting.PsrLogger' => [

        ],
        'error_reporting' => [
            'LoggingClient' =>  [
                'projectId' => 'projectId',
            ],
            'serviceId' => 'serviceId',
            'versionId' => 'versionId',
        ]
    ];

    /** @test */
    public function testReport()
    {
        if (! function_exists('config')) {
            function config($key = null) {
                return ErrorReportingTest::$config[$key];
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
