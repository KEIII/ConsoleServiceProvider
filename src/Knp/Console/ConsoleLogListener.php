<?php

namespace Knp\Console;

use Psr\Log\LoggerInterface;
use Symfony\Component\Console\ConsoleEvents;
use Symfony\Component\Console\Event\ConsoleExceptionEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Console Log Listener
 */
class ConsoleLogListener implements EventSubscriberInterface
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * Constructor.
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * Log exception
     * @param ConsoleExceptionEvent $event
     */
    public function onConsoleError(ConsoleExceptionEvent $event)
    {
        $command = $event->getCommand();
        $exception = $event->getException();

        $message = sprintf(
            '%s: %s (uncaught exception) at %s line %s while running console command `%s`',
            get_class($exception),
            $exception->getMessage(),
            $exception->getFile(),
            $exception->getLine(),
            $command->getName()
        );

        $this->logger->error($message, ['exception' => $exception]);
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            ConsoleEvents::EXCEPTION => ['onConsoleError', -4],
        ];
    }
}
