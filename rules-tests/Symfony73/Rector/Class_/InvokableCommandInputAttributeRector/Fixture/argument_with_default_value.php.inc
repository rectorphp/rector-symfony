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
class ArgumentWithDefaultValue extends Command
{
    protected function configure(): void
    {
        $this->addArgument('first', InputArgument::OPTIONAL, null, 'optional value');
        $this->addArgument('second', InputArgument::REQUIRED, null, 'require value');
    }
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
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
class ArgumentWithDefaultValue
{
    public function __invoke(#[\Symfony\Component\Console\Attribute\Argument(name: 'first', description: null)]
    ?string $first = 'optional value', #[\Symfony\Component\Console\Attribute\Argument(name: 'second', description: null)]
    string $second = 'required value'): int
    {
    }
}

?>
