<?php

declare(strict_types=1);

namespace Phlib\ConsoleProcess\Command\Stub;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

trait ExecuteStubTrait
{
    private int $executeCount = 0;

    private string $executeValue;

    private bool $shutdown = true;

    private int $exitCode = 0;

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->executeCount++;

        if (isset($this->executeValue)) {
            $output->writeln($this->executeValue);
        }

        if ($this->shutdown) {
            $this->shutdown();
        }

        return $this->exitCode;
    }

    public function setExecuteOutput(string $value): self
    {
        $this->executeValue = $value;
        return $this;
    }

    public function setShutdown(bool $shutdown): self
    {
        $this->shutdown = $shutdown;
        return $this;
    }

    public function setExitCode(int $exitCode): self
    {
        $this->exitCode = $exitCode;
        return $this;
    }

    public function getExecuteCount(): int
    {
        return $this->executeCount;
    }
}
