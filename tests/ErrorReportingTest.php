<?php
namespace Tests;

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
        require_once __DIR__ . '/helper.php';

        $errorReporting = new ErrorReporting;
        $errorReporting->setReportCallable([$this, 'mockReportCallable']);
        $errorReporting->report(new Exception('test'));
    }

    public function mockReportCallable($exception)
    {
        $this->assertInstanceOf('Exception', $exception);
    }
}
