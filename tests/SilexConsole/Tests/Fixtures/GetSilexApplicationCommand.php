<?php

namespace KEIII\SilexConsole\Tests\Fixtures;

use KEIII\SilexConsole\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * {@inheritdoc}
 */
class GetSilexApplicationCommand extends Command
{
    /**
     * {@inheritdoc}
     */
    public function configure()
    {
        $this->setName('command:silex');
    }

    /**
     * {@inheritdoc}
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $output->write(get_class($this->getSilexApplication()));
    }
}
