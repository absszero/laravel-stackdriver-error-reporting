# Stackdriver Error Reporting for Laravel

[![Build Status](https://travis-ci.org/absszero/laravel-stackdriver-error-reporting.svg?branch=master)](https://travis-ci.org/absszero/laravel-stackdriver-error-reporting)

## Requirements

Laravel `5.1` ~ `9.x`

## Installation

1. `composer require absszero/laravel-stackdriver-error-reporting`
2. This package provides Package Auto-Discovery.

    For Laravel versions before 5.5, you need to add the ServiceProvider in `config/app.php`
    ```php
    <?php
    ...
    'providers' => [
        Absszero\ErrorReportingServiceProvider::class,
    ```
3. `php artisan vendor:publish --provider="Absszero\ErrorReportingServiceProvider"`

## Configuration
1. Get [service account credentials](https://cloud.google.com/docs/authentication/getting-started)
    with the role `logging.logWriter` ([docs](https://cloud.google.com/error-reporting/docs/iam?hl=en#iam_roles))

2. Store the key file in your project directory and refer to it in your `.env` like this:
    ```
    GOOGLE_APPLICATION_CREDENTIALS=/My_Authentication.json
    ```

3. Edit `app/Exceptions/Handler.php`.
   
   For Laravel 9 and after versions.

    ```php
    <?php
        public function register()
        {
            $this->reportable(function (Throwable $e) {
                (new \Absszero\ErrorReporting)->report($e);
            });
        }
    ```

    For PHP version before 7, replace `\Throwable` with `\Exception`.
    
    ```php
    <?php
        public function report(\Throwable $exception)
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
