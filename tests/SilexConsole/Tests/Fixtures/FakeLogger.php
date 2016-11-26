<?php

namespace KEIII\SilexConsole\Tests\Fixtures;

use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * {@inheritdoc}
 */
class FakeLogger implements LoggerInterface
{
    /**
     * @var OutputInterface
     */
    private $output;

    /**
     * Constructor.
     *
     * @param OutputInterface $output
     */
    public function __construct(OutputInterface $output)
    {
        $this->output = $output;
    }

    /**
     * {@inheritdoc}
     */
    public function emergency($message, array $context = [])
    {
        $this->fakeLog('emergency', $message);
    }

    /**
     * {@inheritdoc}
     */
    public function alert($message, array $context = [])
    {
        $this->fakeLog('alert', $message);
    }

    /**
     * {@inheritdoc}
     */
    public function critical($message, array $context = [])
    {
        $this->fakeLog('critical', $message);
    }

    /**
     * {@inheritdoc}
     */
    public function error($message, array $context = [])
    {
        $this->fakeLog('error', $message);
    }

    /**
     * {@inheritdoc}
     */
    public function warning($message, array $context = [])
    {
        $this->fakeLog('warning', $message);
    }

    /**
     * {@inheritdoc}
     */
    public function notice($message, array $context = [])
    {
        $this->fakeLog('notice', $message);
    }

    /**
     * {@inheritdoc}
     */
    public function info($message, array $context = [])
    {
        $this->fakeLog('info', $message);
    }

    /**
     * {@inheritdoc}
     */
    public function debug($message, array $context = [])
    {
        $this->fakeLog('debug', $message);
    }

    /**
     * {@inheritdoc}
     */
    public function log($level, $message, array $context = [])
    {
        $this->fakeLog($level, $message);
    }

    /**
     * Show log info.
     *
     * @param $level
     * @param $message
     */
    private function fakeLog($level, $message)
    {
        $log = implode('|', ['logger', $level, $message]);
        $this->output->write($log);
    }
}
