# Stackdriver Error Reporting for Laravel

[![Build Status](https://travis-ci.org/absszero/laravel-stackdriver-error-reporting.svg?branch=master)](https://travis-ci.org/absszero/laravel-stackdriver-error-reporting)

## Requirements

Laravel `5.1` ~ `6.4`

## Installation

1. `composer require absszero/laravel-stackdriver-error-reporting`
2. edit `config/app.php`
    ```php
    <?php
    ...
    'providers' => [
        Absszero\ErrorReportingServiceProvider::class,
    ```
3. `php artisan vendor:publish --provider=Absszero\ErrorReportingServiceProvider`

## Configuration
1. get [service account credentials](https://cloud.google.com/docs/authentication/getting-started) and edit `.env`
```
GOOGLE_APPLICATION_CREDENTIALS=/My_Authentication.json
```


3. edit `app/Exceptions/Handler.php`

    ```php
    <?php
        public function report(Exception $exception)
        {
            parent::report($exception);

            if ($this->shouldReport($exception)) {
                (new \Absszero\ErrorReporting)->report($exception);
            }
        }
    ```


## Contributing

1. Fork it!
2. Create your feature branch: `git checkout -b my-new-feature`
3. Commit your changes: `git commit -am 'Add some feature'`
4. Push to the branch: `git push origin my-new-feature`
5. Submit a pull request :D

## Credits

TODO: Write credits

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details
