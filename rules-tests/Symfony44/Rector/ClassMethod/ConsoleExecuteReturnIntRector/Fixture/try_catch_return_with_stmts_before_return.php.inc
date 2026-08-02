<?php

namespace Rector\Symfony\Tests\Symfony44\Rector\ClassMethod\ConsoleExecuteReturnIntRector\Fixture;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class TryCatchReturnWithStmtsBeforeReturnCommand extends Command
{
    public function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            $output->writeln('working');
            return 0;
        } catch (\Exception $exception) {
            $output->writeln($exception->getMessage());
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

final class TryCatchReturnWithStmtsBeforeReturnCommand extends Command
{
    public function execute(InputInterface $input, OutputInterface $output): int
    {
        try {
            $output->writeln('working');
            return 0;
        } catch (\Exception $exception) {
            $output->writeln($exception->getMessage());
            return 1;
        }
    }
}

?>
