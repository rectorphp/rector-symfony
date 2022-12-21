<?php

namespace Rector\Symfony\Tests\Rector\ClassMethod\ConsoleExecuteReturnIntRector\Fixture;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class SkipConstFetch extends Command
{
    public function execute(InputInterface $input, OutputInterface $output): int
    {
        if (mt_rand(0, 100)) {
            return Command::SUCCESS;
        }

        return Command::FAILURE;
    }
}
