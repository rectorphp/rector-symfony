<?php

namespace Rector\Symfony\Tests\Symfony44\Rector\ClassMethod\ConsoleExecuteReturnIntRector\Fixture;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CheckTablesCommand extends Command
{
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        return 0;

        /*

        comment spam

        return 1;
*/
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Symfony44\Rector\ClassMethod\ConsoleExecuteReturnIntRector\Fixture;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CheckTablesCommand extends Command
{
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        return 0;

        /*

        comment spam

        return 1;
*/
    }
}

?>
