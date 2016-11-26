<?php

namespace KEIII\SilexConsole;

use KEIII\SilexConsole\Application as ConsoleApplication;
use Silex\Application as SilexApplication;
use Silex\ServiceProviderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RequestContext;

/**
 * Console Service Provider.
 */
class ConsoleServiceProvider implements ServiceProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function register(SilexApplication $app)
    {
        $app['console'] = $app::share(function (SilexApplication $app) {
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

            // Configuring the Request Context
            if (isset($app['console.request'])) {
                /** @var RequestContext $requestContext */
                $requestContext = $app['request_context'];
                $requestDefaults = [
                    'baseUrl' => '',
                    'method' => 'GET',
                    'host' => 'localhost',
                    'scheme' => 'http',
                    'httpPort' => 80,
                    'httpsPort' => 443,
                    'path' => '/',
                    'queryString' => '',
                ];
                $requestParams = array_merge($requestDefaults, $app['console.request']);

                $requestContext
                    ->setBaseUrl($requestParams['baseUrl'])
                    ->setMethod($requestParams['method'])
                    ->setHost($requestParams['host'])
                    ->setScheme($requestParams['scheme'])
                    ->setHttpPort($requestParams['httpPort'])
                    ->setHttpsPort($requestParams['httpsPort'])
                    ->setPathInfo($requestParams['path'])
                    ->setQueryString($requestParams['queryString'])
                ;
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
