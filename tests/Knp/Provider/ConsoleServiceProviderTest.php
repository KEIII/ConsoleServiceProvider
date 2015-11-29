<?php

namespace Knp\Tests\Provider;

use Knp\Console\Application as ConsoleApplication;
use Knp\Provider\ConsoleServiceProvider;
use Silex\Application as SilexApplication;
use Symfony\Component\Console\Application as BaseConsoleApplication;

/**
 * Test Console Service Provider
 */
class ConsoleServiceProviderTest extends \PHPUnit_Framework_TestCase
{
    public function testRegisterProvider()
    {
        $app = new SilexApplication();
        $app->register(new ConsoleServiceProvider(), [
            'console.name' => 'Awesome name',
            'console.version' => '1.2.3',
        ]);
        /** @var ConsoleApplication $console */
        $console = $app['console'];

        $this->assertTrue($console instanceof ConsoleApplication);
        $this->assertTrue($console instanceof BaseConsoleApplication);
        $this->assertTrue($console->getSilexApplication() instanceof SilexApplication);
        $this->assertEquals('Awesome name', $console->getName());
        $this->assertEquals('1.2.3', $console->getVersion());
    }
}
