<?php

namespace Rector\Symfony\Tests\Rector\ClassMethod\ConsoleExecuteReturnIntRector\Fixture;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class SkipTryCatchReturn extends Command
{
    public function execute(InputInterface $input, OutputInterface $output): int
    {
        try {
            return 0;
        } catch (\Exception $e) {
            return 1;
        }
    }
}
