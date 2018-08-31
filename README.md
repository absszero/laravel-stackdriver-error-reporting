# Stackdriver Error Reporting for Laravel

## Installation

1. `composer require absszero/laravel-stackdriver-error-reporting`
2. `php artisan vendor:publish --provider=Absszero\ErrorReportingServiceProvider`

## Configuration
1. get [Authentication](https://cloud.google.com/docs/authentication/getting-started) and edit `.env`
```
GOOGLE_APPLICATION_CREDENTIALS=/My_Authentication.json
```
2. edit `app/Exceptions/Handler.php`

    ```php
    <?php
        public function report(Exception $exception)
        {
            parent::report($exception);
    
            if ($this->shouldReport($exception)) {
                (new \Absszero\ErrorReporting::class)->report($exception);
            }
        }
    ```


## Contributing

1. Fork it!
2. Create your feature branch: `git checkout -b my-new-feature`
3. Commit your changes: `git commit -am 'Add some feature'`
4. Push to the branch: `git push origin my-new-feature`
5. Submit a pull request :D

## History

TODO: Write history

## Credits

TODO: Write credits

## License

TODO: Write license
