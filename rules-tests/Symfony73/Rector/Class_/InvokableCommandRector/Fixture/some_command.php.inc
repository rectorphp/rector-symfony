<?php

namespace Rector\Symfony\Tests\Symfony73\Rector\Class_\InvokableCommandRector\Fixture;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

#[AsCommand(name: 'some_name')]
final class SomeCommand extends Command
{
    public function configure()
    {
        $this->addArgument('argument', InputArgument::REQUIRED, 'Argument description');
        $this->addOption('option', 'o', InputOption::VALUE_NONE, 'Option description');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $someArgument = $input->getArgument('argument');
        $someOption = $input->getOption('option');

        // ...

        return 1;
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Symfony73\Rector\Class_\InvokableCommandRector\Fixture;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Command\Argument;
use Symfony\Component\Console\Command\Option;

final class SomeCommand
{
    public function __invoke(
        #[Argument]
        string $argument,
        #[Option]
        bool $option = false,
    ) {
        $someArgument = $argument;
        $someOption = $option;

        // ...

        return 1;
    }
}

?>
