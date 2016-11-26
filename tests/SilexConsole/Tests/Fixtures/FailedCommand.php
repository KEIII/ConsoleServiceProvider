<?php

namespace KEIII\SilexConsole\Tests\Fixtures;

use KEIII\SilexConsole\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Failed Command
 * just throw exception.
 */
class FailedCommand extends Command
{
    /**
     * {@inheritdoc}
     */
    public function configure()
    {
        $this->setName('command:failed');
    }

    /**
     * {@inheritdoc}
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        throw new \RuntimeException('something went wrong');
    }
}
