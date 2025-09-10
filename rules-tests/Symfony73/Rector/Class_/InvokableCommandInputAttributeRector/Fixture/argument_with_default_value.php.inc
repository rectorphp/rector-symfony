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
        $this->addOption('third', null, null, '', 'third value');
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
    public function __invoke(
        #[\Symfony\Component\Console\Attribute\Argument(name: 'first')]
        ?string $first = 'optional value',
        #[\Symfony\Component\Console\Attribute\Argument(name: 'second')]
        string $second = 'required value',
        #[\Symfony\Component\Console\Attribute\Option(name: 'third')]
        $third = 'third value'
    ): int
    {
    }
}

?>
