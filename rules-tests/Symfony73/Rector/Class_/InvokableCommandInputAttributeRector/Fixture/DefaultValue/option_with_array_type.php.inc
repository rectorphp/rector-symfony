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
class OptionWithOptionalValue extends Command
{
    protected function configure(): void
    {
        $this->addOption('some-array', null, InputOption::VALUE_IS_ARRAY, '', ['third value']);
        $this->addOption('no-default-array', null, InputOption::VALUE_IS_ARRAY);
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
class OptionWithOptionalValue
{
    public function __invoke(
        #[\Symfony\Component\Console\Attribute\Option(name: 'no-default-array', mode: InputOption::VALUE_IS_ARRAY)]
        array $noDefaultArray,
        #[\Symfony\Component\Console\Attribute\Option(name: 'some-array', mode: InputOption::VALUE_IS_ARRAY)]
        array $someArray = ['third value']
    ): int
    {
    }
}

?>
