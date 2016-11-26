<?php

namespace KEIII\SilexConsole\Tests;

use KEIII\SilexConsole\Application as ConsoleApplication;
use KEIII\SilexConsole\ConsoleServiceProvider;
use Silex\Application as SilexApplication;
use Silex\Provider\TwigServiceProvider;
use Symfony\Component\Console\Application as BaseConsoleApplication;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Routing\RequestContext;

/**
 * Test Console Service Provider.
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
        $app->register(new ConsoleServiceProvider(), [
            'console.name' => 'Awesome name',
            'console.version' => '1.2.3',
            'console.request' => [
                'host' => 'example.com',
                'scheme' => 'https',
                'httpsPort' => 443,
                'url' => 'hello',
            ],
        ]);
        $app->register(new TwigServiceProvider(), [
            'twig.path' => __DIR__.'/Resources/views',
            'twig.options' => ['cache' => false],
        ]);
        $app->get('/test.html', function () {
            return '';
        })->bind('test');
        $app->flush();
        $this->console = $app['console'];
    }

    public function testRegisterProvider()
    {
        self::assertTrue($this->console instanceof ConsoleApplication);
        self::assertTrue($this->console instanceof BaseConsoleApplication);
        self::assertTrue($this->console->getSilexApplication() instanceof SilexApplication);
        self::assertEquals('Awesome name', $this->console->getName());
        self::assertEquals('1.2.3', $this->console->getVersion());
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

    public function testUrlGenerator()
    {
        $app = $this->console->getSilexApplication();
        /** @var UrlGeneratorInterface $urlGenerator */
        $urlGenerator = $app['url_generator'];
        $url = $urlGenerator->generate('test', [], UrlGeneratorInterface::ABSOLUTE_URL);

        $this->assertEquals('https://example.com/test.html', $url);
    }

    public function testTwigRender()
    {
        $app = $this->console->getSilexApplication();
        /** @var \Twig_Environment $twig */
        $twig = $app['twig'];
        $content = trim($twig->render('test.twig'));

        $this->assertEquals('https://example.com/test.html', $content);
    }
}
