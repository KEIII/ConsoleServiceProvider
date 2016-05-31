<?php

namespace KEIII\Tests\Provider;

use KEIII\Console\Application as ConsoleApplication;
use KEIII\Provider\ConsoleServiceProvider;
use Silex\Application as SilexApplication;
use Symfony\Component\Console\Application as BaseConsoleApplication;
use Symfony\Component\Routing\RequestContext;

/**
 * Test Console Service Provider
 */
class ConsoleServiceProviderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ConsoleApplication
     */
    private $console;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        $app = new SilexApplication();
        $app->register(new ConsoleServiceProvider(), array(
            'console.name' => 'Awesome name',
            'console.version' => '1.2.3',
            'console.request' => array(
                'host' => 'example.com',
                'scheme' => 'https',
                'httpsPort' => 443,
                'url' => 'hello',
            ),
        ));
        $this->console = $app['console'];
    }

    public function testRegisterProvider()
    {
        $this->assertTrue($this->console instanceof ConsoleApplication);
        $this->assertTrue($this->console instanceof BaseConsoleApplication);
        $this->assertTrue($this->console->getSilexApplication() instanceof SilexApplication);
        $this->assertEquals('Awesome name', $this->console->getName());
        $this->assertEquals('1.2.3', $this->console->getVersion());
    }

    public function testRequestAccess()
    {
        $app = $this->console->getSilexApplication();
        /** @var RequestContext $requestContext */
        $requestContext = $app['request_context'];

        $this->assertEquals('example.com', $requestContext->getHost());
        $this->assertEquals('https', $requestContext->getScheme());
        $this->assertEquals(443, $requestContext->getHttpsPort());
        $this->assertEquals('', $requestContext->getBaseUrl());
    }
}
