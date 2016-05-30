<?php

namespace KEIII\Command;

use KEIII\Console\Application;
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
