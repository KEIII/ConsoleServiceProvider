<?php

namespace KEIII\Provider;

use KEIII\Console\Application as ConsoleApplication;
use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Console Service Provider
 */
class ConsoleServiceProvider implements ServiceProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function register(Container $app)
    {
        $app['console'] = function (Container $app) {
            /**
             * To use Twig we must set up the Request.
             *
             * Configuring the Request Context:
             * http://symfony.com/doc/current/cookbook/console/sending_emails.html
             */
            try {
                $app['request'];
            } catch (\InvalidArgumentException $e) {
                $app['request'] = new Request();
            }

            $console = new ConsoleApplication($app);
            $console->setDispatcher($app['dispatcher']);

            return $console;
        };
    }
}
