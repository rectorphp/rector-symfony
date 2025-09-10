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
class ImplicitNoValueBoolOption extends Command
{
    protected function configure(): void
    {
        $this->addOption('third', null, InputOption::VALUE_NONE);
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
class ImplicitNoValueBoolOption
{
    public function __invoke(
        #[\Symfony\Component\Console\Attribute\Option(name: 'third', mode: InputOption::VALUE_NONE)]
        bool $third = false
    ): int
    {
    }
}

?>
