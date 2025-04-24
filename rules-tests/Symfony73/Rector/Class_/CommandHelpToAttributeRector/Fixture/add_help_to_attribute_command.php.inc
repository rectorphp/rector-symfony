<?php

namespace Rector\Symfony\Tests\Symfony73\Rector\Class_\CommandHelpToAttributeRector\Fixture;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;

#[AsCommand(name: 'some_name')]
final class AddHelpToAttributeCommand extends Command
{
    public function configure()
    {
        $this->setHelp('Some help text');
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Symfony73\Rector\Class_\CommandHelpToAttributeRector\Fixture;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;

#[AsCommand(name: 'some_name', help: <<<'TXT'
Some help text
TXT)]
final class AddHelpToAttributeCommand extends Command
{
    public function configure()
    {
    }
}

?>
