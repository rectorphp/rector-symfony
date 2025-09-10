<?php

namespace Rector\Symfony\Tests\Symfony73\Rector\Class_\InvokableCommandInputAttributeRector\Fixture;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'some_name')]
final class WithoutConfigure extends Command
{
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        // ...

        return 1;
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Symfony73\Rector\Class_\InvokableCommandInputAttributeRector\Fixture;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'some_name')]
final class WithoutConfigure
{
    public function __invoke(): int
    {
        // ...
        return 1;
    }
}

?>
