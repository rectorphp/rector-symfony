<?php

namespace Rector\Symfony\Tests\Symfony44\Rector\ClassMethod\ConsoleExecuteReturnIntRector\Fixture;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class SkipTernaryReturnWithNullIf extends Command
{
    public function execute(InputInterface $input, OutputInterface $output): int
    {
        return rand(0, 1) ?: 1;
    }
}
