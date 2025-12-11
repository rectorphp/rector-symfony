<?php

namespace Rector\Symfony\Tests\Symfony73\Rector\Class_\InvokableCommandInputAttributeRector\Fixture;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:hello',
    description: 'Greet the user.',
)]
class NameFromConstant extends Command
{
    private const string ARGUMENT_NAME = 'name';

    #[\Override]
    protected function configure(): void
    {
        $this->addArgument(self::ARGUMENT_NAME, InputArgument::OPTIONAL, 'The name of the person to greet.');
    }

    #[\Override]
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $name = $input->getArgument(self::ARGUMENT_NAME);
        $output->writeln("Hello {$name}!");

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
    description: 'Greet the user.',
)]
class NameFromConstant
{
    private const string ARGUMENT_NAME = 'name';
    public function __invoke(
        #[\Symfony\Component\Console\Attribute\Argument(name: self::ARGUMENT_NAME, description: 'The name of the person to greet.')]
        ?string $name,
        OutputInterface $output
    ): int
    {
        $name = $input->getArgument(self::ARGUMENT_NAME);
        $output->writeln("Hello {$name}!");
        return Command::SUCCESS;
    }
}

?>
