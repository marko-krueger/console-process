<?php

declare(strict_types=1);

namespace Phlib\ConsoleProcess\Command\Stub;

use Phlib\ConsoleProcess\Command\DaemonCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @package Phlib\Console-Process
 */
class DaemonCommandStub extends DaemonCommand
{
    use ExecuteStubTrait;

    private string $shutdownValue;

    private \Closure $outputCallback;

    protected function onShutdown(InputInterface $input, OutputInterface $output): void
    {
        if (isset($this->shutdownValue)) {
            $output->writeln($this->shutdownValue);
        }
    }

    public function setShutdownOutput(string $value): self
    {
        $this->shutdownValue = $value;
        return $this;
    }

    protected function createChildOutput(?string $childLogFilename): OutputInterface
    {
        if (isset($this->outputCallback)) {
            return ($this->outputCallback)();
        }

        return parent::createChildOutput($childLogFilename);
    }

    public function setOutputCallback(\Closure $callback): self
    {
        $this->outputCallback = $callback;
        return $this;
    }
}
