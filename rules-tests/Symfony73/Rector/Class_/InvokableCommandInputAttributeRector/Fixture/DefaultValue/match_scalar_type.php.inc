<?php

namespace Rector\Symfony\Tests\Symfony73\Rector\Class_\InvokableCommandInputAttributeRector\Fixture\DefaultValue;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:hello',
)]
class MatchScalarType extends Command
{
    protected function configure(): void
    {
        $this->addArgument('first', InputArgument::OPTIONAL, null, 100);
        $this->addArgument('second', InputArgument::REQUIRED, null, 200.5);

        $this->addOption('third', '', null, null, 200);
        $this->addOption('fourth', '', null, null, 400.5);
    }
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Symfony73\Rector\Class_\InvokableCommandInputAttributeRector\Fixture\DefaultValue;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:hello',
)]
class MatchScalarType
{
    public function __invoke(
        #[\Symfony\Component\Console\Attribute\Argument(name: 'second')]
        float $second = 200.5,
        #[\Symfony\Component\Console\Attribute\Option(name: 'fourth')]
        float $fourth = 400.5,
        #[\Symfony\Component\Console\Attribute\Argument(name: 'first')]
        ?int $first = 100,
        #[\Symfony\Component\Console\Attribute\Option(name: 'third')]
        int $third = 200
    ): int
    {
    }
}

?>
