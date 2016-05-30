<?php

namespace KEIII\Tests\Fixtures;

use KEIII\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Failed Command
 * just throw exception
 */
class FailedCommand extends Command
{
    /**
     * {@inheritDoc}
     */
    public function configure()
    {
        $this->setName('command:failed');
    }

    /**
     * {@inheritDoc}
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        throw new \Exception('something went wrong');
    }
}
