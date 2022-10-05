<?php

namespace Rector\Symfony\Tests\Rector\ClassMethod\CommandConstantReturnCodeRector\Fixture;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SkipAlreadyUsingConstantNestedFunction extends Command
{
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        try {
            return $this->executeCommandStuff();
        } catch (\Exception) {
            return Command::FAILURE;
        }
    }

    private function executeCommandStuff(): int
    {
        return Command::SUCCESS;
    }
}

?>
