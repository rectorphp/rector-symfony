<?php

namespace Rector\Symfony\Tests\Symfony73\Rector\Class_\InvokableCommandInputAttributeRector\Fixture;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'ack:alarm',
    description: '',
)]
class WithNamedArgModeDifferentPosition extends Command
{
    protected function configure(): void
    {
        $this
            ->addOption(
                name: 'startDate',
                mode: InputOption::VALUE_REQUIRED,
                description: 'non empty description needed to reproduce the bug',
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        return Command::SUCCESS;
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Symfony73\Rector\Class_\InvokableCommandInputAttributeRector\Fixture;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'ack:alarm',
    description: '',
)]
class WithNamedArgModeDifferentPosition
{
    public function __invoke(
        #[\Symfony\Component\Console\Attribute\Option(name: 'startDate', mode: InputOption::VALUE_REQUIRED, description: 'non empty description needed to reproduce the bug')]
        $startdate
    ): int
    {
        return Command::SUCCESS;
    }
}

?>