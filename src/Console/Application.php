<?php

namespace KEIII\Console;

use Silex\Application as SilexApplication;
use Symfony\Component\Console\Application as BaseApplication;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Console Application
 */
class Application extends BaseApplication
{
    /**
     * @var SilexApplication
     */
    private $silexApp;

    /**
     * Constructor.
     * @param SilexApplication $app
     */
    public function __construct(SilexApplication $app)
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
     * {@inheritDoc}
     */
    public function run(InputInterface $input = null, OutputInterface $output = null)
    {
        $this->getSilexApplication()->boot();

        return parent::run($input, $output);
    }
}
