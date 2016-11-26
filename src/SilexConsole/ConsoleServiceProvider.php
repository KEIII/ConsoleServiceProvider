<?php

namespace KEIII\SilexConsole;

use KEIII\SilexConsole\Application as ConsoleApplication;
use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Symfony\Component\Routing\RequestContext;

/**
 * Console Service Provider.
 */
class ConsoleServiceProvider implements ServiceProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function register(Container $app)
    {
        $app['console'] = function (Container $app) {
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
        };
    }
}
