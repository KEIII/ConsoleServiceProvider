<?php

namespace KEIII\Tests\Fixtures;

use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * {@inheritDoc}
 */
class FakeLogger implements LoggerInterface
{
    /**
     * @var OutputInterface
     */
    private $output;

    /**
     * Constructor.
     * @param OutputInterface $output
     */
    public function __construct(OutputInterface $output)
    {
        $this->output = $output;
    }

    /**
     * {@inheritDoc}
     */
    public function emergency($message, array $context = [])
    {
        $this->fakeLog('emergency', $message);
    }

    /**
     * {@inheritDoc}
     */
    public function alert($message, array $context = [])
    {
        $this->fakeLog('alert', $message);
    }

    /**
     * {@inheritDoc}
     */
    public function critical($message, array $context = [])
    {
        $this->fakeLog('critical', $message);
    }

    /**
     * {@inheritDoc}
     */
    public function error($message, array $context = [])
    {
        $this->fakeLog('error', $message);
    }

    /**
     * {@inheritDoc}
     */
    public function warning($message, array $context = [])
    {
        $this->fakeLog('warning', $message);
    }

    /**
     * {@inheritDoc}
     */
    public function notice($message, array $context = [])
    {
        $this->fakeLog('notice', $message);
    }

    /**
     * {@inheritDoc}
     */
    public function info($message, array $context = [])
    {
        $this->fakeLog('info', $message);
    }

    /**
     * {@inheritDoc}
     */
    public function debug($message, array $context = [])
    {
        $this->fakeLog('debug', $message);
    }

    /**
     * {@inheritDoc}
     */
    public function log($level, $message, array $context = [])
    {
        $this->fakeLog($level, $message);
    }

    /**
     * Show log info
     * @param $level
     * @param $message
     */
    private function fakeLog($level, $message)
    {
        $log = implode('|', ['logger', $level, $message]);
        $this->output->write($log);
    }
}
