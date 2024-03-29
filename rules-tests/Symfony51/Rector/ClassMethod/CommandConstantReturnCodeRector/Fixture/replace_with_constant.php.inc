<?php

namespace Rector\Symfony\Tests\Symfony51\Rector\ClassMethod\CommandConstantReturnCodeRector\Fixture;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ReplaceWithConstant extends Command
{
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        return 0;
    }

}

?>
-----
<?php

namespace Rector\Symfony\Tests\Symfony51\Rector\ClassMethod\CommandConstantReturnCodeRector\Fixture;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ReplaceWithConstant extends Command
{
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        return \Symfony\Component\Console\Command\Command::SUCCESS;
    }

}

?>
