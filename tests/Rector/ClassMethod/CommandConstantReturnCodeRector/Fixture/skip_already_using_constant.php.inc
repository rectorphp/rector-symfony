<?php

namespace Rector\Symfony\Tests\Rector\ClassMethod\CommandConstantReturnCodeRector\Fixture;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SkipAlreadyUsingConstant extends Command
{
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        return Command::SUCCESS;
    }
}

?>
