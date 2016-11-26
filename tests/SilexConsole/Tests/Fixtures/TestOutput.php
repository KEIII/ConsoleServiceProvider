<?php

namespace KEIII\SilexConsole\Tests\Fixtures;

use Symfony\Component\Console\Output\Output;

/**
 * {@inheritdoc}
 */
class TestOutput extends Output
{
    public $output = '';

    public function clear()
    {
        $this->output = '';
    }

    /**
     * {@inheritdoc}
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
