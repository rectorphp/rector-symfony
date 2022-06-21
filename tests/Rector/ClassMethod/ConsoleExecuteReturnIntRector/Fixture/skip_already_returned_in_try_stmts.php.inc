<?php

namespace Rector\Symfony\Tests\Rector\ClassMethod\ConsoleExecuteReturnIntRector\Fixture;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class SkipAlreadyReturnedInTryStmts  extends Command
{
    private const SUCCESS = 0;
    private const FAILURE = 1;

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        try {
            $this->service->foo();
            return self::SUCCESS;
        } catch (\Throwable $exception) {
            return self::FAILURE;
        }
    }
}
