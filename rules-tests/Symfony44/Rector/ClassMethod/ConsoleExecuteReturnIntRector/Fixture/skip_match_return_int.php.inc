<?php

namespace Rector\Symfony\Tests\Symfony44\Rector\ClassMethod\ConsoleExecuteReturnIntRector\Fixture;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class SkipMatchReturnInt extends Command
{
    public function execute(InputInterface $input, OutputInterface $output): int
    {
        return match ($input->getArgument('type')) {
            'a' => 0,
            default => 1,
        };
    }
}
