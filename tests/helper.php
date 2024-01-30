<?php

use Illuminate\Support\Arr;
use Tests\ErrorReportingTest;

if (! function_exists('config')) {
    function config($key = null)
    {
        return Arr::get(['error_reporting' => ErrorReportingTest::$config], $key);
    }
}
