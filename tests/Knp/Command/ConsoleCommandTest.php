<?php

namespace Knp\Tests\Command;

use Knp\Console\Application as ConsoleApplication;
use Knp\Console\ConsoleLogListener;
use Knp\Provider\ConsoleServiceProvider;
use Knp\Tests\Fixtures\FailedCommand;
use Knp\Tests\Fixtures\FakeLogger;
use Knp\Tests\Fixtures\GetSilexApplicationCommand;
use Knp\Tests\Fixtures\SampleCommand;
use Knp\Tests\Fixtures\TestOutput;
use Silex\Application as SilexApplication;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Component\EventDispatcher\EventDispatcher;

/**
 * Console Command Test
 */
class ConsoleCommandTest extends \PHPUnit_Framework_TestCase
{
    public function testSampleCommand()
    {
        $app = new SilexApplication();
        $app->register(new ConsoleServiceProvider());
        $output = new BufferedOutput();
        $input = new ArrayInput([
            'command' => 'command:sample',
            'name' => 'John Smith',
        ]);

        /** @var ConsoleApplication $console */
        $console = $app['console'];
        $console->setAutoExit(false);
        $console->add(new SampleCommand());
        $console->run($input, $output);

        $this->assertEquals('Hello, John Smith!', $output->fetch());
    }

    public function testGetSilexApplicationCommand()
    {
        $app = new SilexApplication();
        $app->register(new ConsoleServiceProvider());
        $output = new BufferedOutput();
        $input = new ArrayInput([
            'command' => 'command:silex',
        ]);

        /** @var ConsoleApplication $console */
        $console = $app['console'];
        $console->setAutoExit(false);
        $console->add(new GetSilexApplicationCommand());
        $console->run($input, $output);

        $this->assertEquals('Silex\Application', $output->fetch());
    }

    public function testFailedCommand()
    {
        $app = new SilexApplication();
        $app->register(new ConsoleServiceProvider());

        $log_output = new TestOutput();
        $input = new ArrayInput([
            'command' => 'command:failed',
        ]);

        /** @var EventDispatcher $dispatcher */
        $dispatcher = $app['dispatcher'];
        $logger = new FakeLogger($log_output);
        $subscriber = new ConsoleLogListener($logger);
        $dispatcher->addSubscriber($subscriber);

        /** @var ConsoleApplication $console */
        $console = $app['console'];
        $console->setAutoExit(false);
        $console->add(new FailedCommand());
        $console->run($input, null);

        $this->assertContains('logger|error|Exception: something went wrong', $log_output->fetch());
    }
}
