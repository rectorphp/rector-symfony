<?php

namespace Rector\Symfony\Tests\Rector\Return_\SimpleFunctionAndFilterRector\Fixture;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SkipOtherFunctionCallReturnInt extends Command
{
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->executeCommandStuff();

        return Command::SUCCESS;
    }

    private function executeCommandStuff(): int
    {
        return 0;
    }
}

?>
