<?php

namespace Rector\Symfony\Tests\Symfony73\Rector\Class_\InvokableCommandInputAttributeRector\Fixture;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

#[AsCommand(name: 'some_name')]
final class OptionNameConstant extends Command
{
    private const ARGUMENT_NAME = 'some-argument';

    private const OPTION_NAME = 'some-option';

    public function configure()
    {
        $this->addArgument(self::ARGUMENT_NAME);
        $this->addOption(self::OPTION_NAME);
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $someArgument = $input->getArgument(self::ARGUMENT_NAME);

        $someOption = $input->getOption(self::OPTION_NAME);

        // ...

        return 1;
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Symfony73\Rector\Class_\InvokableCommandInputAttributeRector\Fixture;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

#[AsCommand(name: 'some_name')]
final class OptionNameConstant
{
    private const ARGUMENT_NAME = 'some-argument';

    private const OPTION_NAME = 'some-option';
    public function __invoke(
        #[\Symfony\Component\Console\Attribute\Argument(name: self::ARGUMENT_NAME)]
        ?string $someArgument,
        #[\Symfony\Component\Console\Attribute\Option(name: self::OPTION_NAME)]
        $someOption
    ): int
    {
        $someArgument = $input->getArgument(self::ARGUMENT_NAME);
        $someOption = $input->getOption(self::OPTION_NAME);
        // ...
        return 1;
    }
}

?>
