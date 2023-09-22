<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\MakeCommandLazyRector\Fixture;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MethodChainingWithOptionsCommand extends \Symfony\Component\Console\Command\Command
{
    protected function configure(): void
    {
        $this
            ->setName('some-command')
            ->addOption(
                'some_option',
                null,
                InputOption::VALUE_OPTIONAL,
                'Some text'
            )
            ->setDescription('some_description')
            ->addOption('some_other_option', 'i', InputOption::VALUE_NONE, 'Some other text');
    }

    protected function execute(InputInterface $input, OutputInterface $output) {}
}

?>
-----
<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\MakeCommandLazyRector\Fixture;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MethodChainingWithOptionsCommand extends \Symfony\Component\Console\Command\Command
{
    protected static $defaultName = 'some-command';
    protected function configure(): void
    {
        $this
            ->addOption(
                'some_option',
                null,
                InputOption::VALUE_OPTIONAL,
                'Some text'
            )
            ->setDescription('some_description')
            ->addOption('some_other_option', 'i', InputOption::VALUE_NONE, 'Some other text');
    }

    protected function execute(InputInterface $input, OutputInterface $output) {}
}

?>
