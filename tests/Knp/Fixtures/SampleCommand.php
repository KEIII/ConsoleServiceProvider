<?php

namespace Knp\Tests\Fixtures;

use Knp\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Test Command
 */
class SampleCommand extends Command
{
    /**
     * {@inheritDoc}
     */
    public function configure()
    {
        $this->setName('command:sample');
        $this->setDescription('Sample command');
        $this->addArgument('name', InputArgument::REQUIRED);
    }

    /**
     * {@inheritDoc}
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $output->write('Hello, ' . $input->getArgument('name') . '!');
    }
}
