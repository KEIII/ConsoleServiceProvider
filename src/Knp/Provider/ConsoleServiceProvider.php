<?php

namespace Knp\Provider;

use Knp\Console\Application as ConsoleApplication;
use Silex\Application as SilexApplication;
use Silex\ServiceProviderInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Console Service Provider
 */
class ConsoleServiceProvider implements ServiceProviderInterface
{
    /**
     * @param SilexApplication $app
     */
    public function register(SilexApplication $app)
    {
        $app['console'] = $app->share(function (SilexApplication $app) {
            /**
             * To use Twig we must set up the Request.
             *
             * Configuring the Request Context:
             * http://symfony.com/doc/current/cookbook/console/sending_emails.html
             */
            try {
                $app['request'];
            } catch (\RuntimeException $e) {
                $app['request'] = new Request();
            }

            $console = new ConsoleApplication($app);
            $console->setDispatcher($app['dispatcher']);

            return $console;
        });
    }

    /**
     * @param SilexApplication $app
     */
    public function boot(SilexApplication $app)
    {
        // required by interface
    }
}
