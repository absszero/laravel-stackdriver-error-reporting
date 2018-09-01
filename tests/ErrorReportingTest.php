<?php

use Absszero\ErrorReporting;

class ErrorReportingTest extends PHPUnit_Framework_TestCase
{
    public static $config = [
        'error_reporting.log_name' => 'name',
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

    public function setUp()
    {
        if (! function_exists('config')) {
            function config($key = null) {
                return ErrorReportingTest::$config[$key];
            }
        }
    }

    /** @test */
    public function testReport()
    {
        $errorReporting = new ErrorReporting;
        $errorReporting->setReportCallable([$this, 'mockReportCallable']);
        $errorReporting->report(new Exception('test'));
    }

    public function mockReportCallable($exception)
    {
        $this->assertInstanceOf('Exception', $exception);
    }
}
