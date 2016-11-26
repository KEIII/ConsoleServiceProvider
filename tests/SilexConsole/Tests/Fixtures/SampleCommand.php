<?php

namespace KEIII\SilexConsole\Tests\Fixtures;

use KEIII\SilexConsole\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Test Command.
 */
class SampleCommand extends Command
{
    /**
     * {@inheritdoc}
     */
    public function configure()
    {
        $this->setName('command:sample');
        $this->setDescription('Sample command');
        $this->addArgument('name', InputArgument::REQUIRED);
    }

    /**
     * {@inheritdoc}
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $output->write('Hello, '.$input->getArgument('name').'!');
    }
}
