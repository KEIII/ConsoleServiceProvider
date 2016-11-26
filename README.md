# ConsoleServiceProvider
[![Build Status](https://travis-ci.org/KEIII/ConsoleServiceProvider.svg?branch=master)](https://travis-ci.org/KEIII/ConsoleServiceProvider)

Provides a `Symfony\Component\Console` based console for Silex.

## Download and Installation
```
$ composer require keiii/console-service-provider
```

## Registering
```php
#!/usr/bin/env php
<?php
$app = new Application();
$app->register(new ConsoleServiceProvider(), array(
    'console.name' => 'MyApplication',
    'console.version' => '1.0.0',
));
$console = $app['console'];
$console->add(new MyCommand());
$console->run();
```

## Write commands
Your commands should extend `KEIII\SilexConsole\Command` to have access `getSilexApplication`, which returns the silex application.

## Usage
Use the console just like any `Symfony\Component` based console:
```
$ app/console my:command
```

## Log exceptions
```php
<?php
$app['logger'] = $app::share(function () {
    return new MyLogger(); // \Psr\Log\LoggerInterface
});
$app['console.log.listener'] = $app::share(function (Application $app) {
    return new \KEIII\SilexConsole\ConsoleLogListener($app['logger']);
});
$app['dispatcher']->addSubscriber($app['console.log.listener']);
```
