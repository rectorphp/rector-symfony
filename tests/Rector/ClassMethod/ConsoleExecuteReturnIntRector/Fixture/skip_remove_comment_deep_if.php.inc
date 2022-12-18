<?php

namespace Rector\Symfony\Tests\Rector\ClassMethod\ConsoleExecuteReturnIntRector\Fixture;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class UpdateLeadListsCommand extends Command
{
    protected function execute(InputInterface $input, OutputInterface $output): int
    {

        if (rand(0, 1)) {
            if (rand(1,2)) {
                if (rand(3,4)) {
                    try {
                        if (rand(5,6)) {
                            // Only full segment rebuilds count
							echo 'some statement';
                        }
                    } catch (QueryException $e) {
                        return 1;
                    }
                }
            } else {
                return 2;
            }
        }

        return 0;
    }
}