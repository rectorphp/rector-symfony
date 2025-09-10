<?php

namespace Rector\Symfony\Tests\Symfony73\Rector\Class_\InvokableCommandInputAttributeRector\Fixture\DefaultValue;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:hello',
)]
class IterableTypeWithDefaultValue extends Command
{
    protected function configure(): void
    {
        $this->addArgument('iterable', InputArgument::REQUIRED | InputArgument::IS_ARRAY, null, ['many values']);
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
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:hello',
)]
class IterableTypeWithDefaultValue
{
    public function __invoke(
        #[\Symfony\Component\Console\Attribute\Argument(name: 'iterable')]
        array $iterable = ['many values']
    ): int
    {
    }
}

?>
