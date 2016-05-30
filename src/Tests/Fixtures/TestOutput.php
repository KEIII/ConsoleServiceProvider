<?php

namespace KEIII\Tests\Fixtures;

use Symfony\Component\Console\Output\Output;

/**
 * {@inheritDoc}
 */
class TestOutput extends Output
{
    public $output = '';

    public function clear()
    {
        $this->output = '';
    }

    /**
     * {@inheritDoc}
     */
    protected function doWrite($message, $newline)
    {
        $this->output .= $message.($newline ? "\n" : '');
    }

    /**
     * Empties buffer and returns its content.
     *
     * @return string
     */
    public function fetch()
    {
        $content = $this->output;
        $this->clear();

        return $content;
    }
}
