<?php

return [
    'logName' => config('app.name'),
    'serviceId' => config('app.name'),
    'versionId' => null,
    'LoggingClient' => [
        // The project ID from the Google Developer's Console.
        'projectId' => env('GOOGLE_CLOUD_PROJECT'),
        // The full path to your service account credentials .json file retrieved from the Google Developers Console.
        'keyFilePath' => env('GOOGLE_APPLICATION_CREDENTIALS'),
        // Seconds to wait before timing out the request.
        // **Defaults to** `0` with REST and `60` with gRPC.
        'requestTimeout' => 0,
        // Number of retries for a failed request.
        'retries' => 3,
        // The transport type used for requests.
        // May be either `grpc` or `rest`.
        // **Defaults to** `grpc` if gRPC support  is detected on the system.
        'transport' => null
    ],
    'PsrLogger' => [
        // Determines whether or not to use background batching.
        'batchEnabled' => true,
        //  Whether or not to output debug information.
        'debugOutput' => false,
        // A set of options for a BatchJob.
        'batchOptions' => [
            'numWorkers' => 2
        ],

    ]
];
