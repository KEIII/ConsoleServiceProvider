<?php

namespace KEIII\SilexConsole;

use Pimple\Container;
use Silex\Application as SilexApplication;
use Symfony\Component\Console\Application as BaseApplication;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Console Application.
 */
class Application extends BaseApplication
{
    /**
     * @var SilexApplication
     */
    private $silexApp;

    /**
     * Constructor.
     *
     * @param Container $app
     */
    public function __construct(Container $app)
    {
        $name = isset($app['console.name']) ? $app['console.name'] : null;
        $version = isset($app['console.version']) ? $app['console.version'] : null;

        parent::__construct($name, $version);

        $this->silexApp = $app;
    }

    /**
     * @return SilexApplication
     */
    public function getSilexApplication()
    {
        return $this->silexApp;
    }

    /**
     * {@inheritdoc}
     */
    public function run(InputInterface $input = null, OutputInterface $output = null)
    {
        $silexApp = $this->getSilexApplication();
        $silexApp->boot();
        $silexApp->flush();

        return parent::run($input, $output);
    }
}
