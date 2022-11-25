<?php

namespace Rector\Symfony\Tests\Rector\ClassMethod\CommandConstantReturnCodeRector\Fixture;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ReplaceInvalid extends Command
{
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        return 2;
    }

}

?>
-----
<?php

namespace Rector\Symfony\Tests\Rector\ClassMethod\CommandConstantReturnCodeRector\Fixture;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ReplaceInvalid extends Command
{
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        return Symfony\Component\Console\Command\Command::INVALID;
    }

}

?>
