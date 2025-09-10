<?php

namespace Rector\Symfony\Tests\Symfony73\Rector\Class_\InvokableCommandInputAttributeRector\Fixture;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:hello',
)]
class NameWithHyphen extends Command
{
    protected function configure(): void
    {
        $this->addArgument('argument-with-hyphen', InputArgument::OPTIONAL, 'Argument description');
        $this->addOption('option-with-hyphen');
    }
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $argument = $input->getArgument('argument-with-hyphen');
        $option = $input->getOption('option-with-hyphen');
        return Command::SUCCESS;
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Symfony73\Rector\Class_\InvokableCommandInputAttributeRector\Fixture;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:hello',
)]
class NameWithHyphen
{
    public function __invoke(#[\Symfony\Component\Console\Attribute\Argument(name: 'argument-with-hyphen', description: 'Argument description')]
    ?string $argument_with_hyphen, #[\Symfony\Component\Console\Attribute\Option]
    $option_with_hyphen): int
    {
        $argument = $argument_with_hyphen;
        $option = $option_with_hyphen;
        return Command::SUCCESS;
    }
}

?>
