<?php

namespace Rector\Symfony\Tests\Symfony44\Rector\ClassMethod\ConsoleExecuteReturnIntRector\Fixture;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class MultipleReturnCommand extends Command
{
    public function execute(InputInterface $input, OutputInterface $output)
    {
        if ($earlyReturn) {
            return null;
        }

        if ($errorCondition) {
            return 1;
        }
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Symfony44\Rector\ClassMethod\ConsoleExecuteReturnIntRector\Fixture;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class MultipleReturnCommand extends Command
{
    public function execute(InputInterface $input, OutputInterface $output): int
    {
        if ($earlyReturn) {
            return 0;
        }

        if ($errorCondition) {
            return 1;
        }
        return 0;
    }
}

?>
