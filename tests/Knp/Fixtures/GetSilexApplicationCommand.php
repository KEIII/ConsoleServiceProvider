<?php

namespace Knp\Tests\Fixtures;

use Knp\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * {@inheritDoc}
 */
class GetSilexApplicationCommand extends Command
{
    /**
     * {@inheritDoc}
     */
    public function configure()
    {
        $this->setName('command:silex');
    }

    /**
     * {@inheritDoc}
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $output->write(get_class($this->getSilexApplication()));
    }
}
