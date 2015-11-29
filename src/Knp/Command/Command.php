<?php

namespace Knp\Command;

use Knp\Console\Application;
use Silex\Application as SilexApplication;
use Symfony\Component\Console\Command\Command as BaseCommand;

/**
 * Abstract Console Command
 */
abstract class Command extends BaseCommand
{
    /**
     * @return SilexApplication
     */
    public function getSilexApplication()
    {
        /** @var Application $console */
        $console = $this->getApplication();

        return $console->getSilexApplication();
    }
}
