# ConsoleServiceProvider
[![Build Status](https://travis-ci.org/KEIII/ConsoleServiceProvider.svg?branch=master)](https://travis-ci.org/KEIII/ConsoleServiceProvider)

Provides a `Symfony\Component\Console` based console for Silex.

## Download and Installation
```
$ composer require knplabs/console-service-provider
```

## Registering
```php
#!/usr/bin/env php
<?php

set_time_limit(0);
require_once(__DIR__ . '/../vendor/autoload.php');

$app = \Silex\Application();
$app->register(new \Knp\Provider\ConsoleServiceProvider(), [
    'console.name' => 'MyApplication',
    'console.version' => '1.0.0',
]);
$console = $app['console'];
$console->add(new MyCommand());
$console->run();
```

## Write commands
Your commands should extend `Knp\Command\Command` to have access `getSilexApplication`, which returns the silex application.

## Usage
Use the console just like any `Symfony\Component` based console:
```
$ app/console my:command
```

## Log exceptions
```php
<?php

$app['console.log.listener'] = $app->share(function (Application $app) {
    /** @var \Psr\Log\LoggerInterface $logger */
    $logger = new MyLogger();

    return new \Knp\Console\ConsoleLogListener($logger);
});

$app['dispatcher']->addSubscriber($app['console.log.listener']);
```
