<?php

namespace Rector\Symfony\Tests\Issues\Issue638\Fixture;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class NameAndDescriptionOrder extends Command
{
    private const COMMAND = 'command';

    protected static $defaultName = 'app:'.self::COMMAND.':process';

    protected function configure(): void
    {
        $this->setDescription('description of the command');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        //...
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Issues\Issue638\Fixture;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[\Symfony\Component\Console\Attribute\AsCommand(name: 'app:'.self::COMMAND.':process', description: 'description of the command')]
final class NameAndDescriptionOrder extends Command
{
    private const COMMAND = 'command';

    protected function configure(): void
    {
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        //...
    }
}

?>
