<?php

require_once __DIR__ . '/ExecuteStubTrait.php';

use Phlib\ConsoleProcess\Command\DaemonCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DaemonCommandStub extends DaemonCommand
{
    use ExecuteStubTrait;

    /**
     * @var string|null
     */
    protected $shutdownValue = null;

    /**
     * @var \Closure
     */
    protected $outputCallback;

    protected function onShutdown(InputInterface $input, OutputInterface $output)
    {
        if ($this->shutdownValue !== null) {
            $output->writeln($this->shutdownValue);
        }
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setShutdownOutput($value)
    {
        $this->shutdownValue = $value;
        return $this;
    }

    /**
     * @return mixed
     */
    protected function createChildOutput()
    {
        return call_user_func($this->outputCallback);
    }

    /**
     * @return $this
     */
    public function setOutputCallback(\Closure $callback)
    {
        $this->outputCallback = $callback;
        return $this;
    }
}
