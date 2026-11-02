<?php

namespace Rector\Symfony\Tests\Symfony61\Rector\Class_\CommandConfigureToAttributeRector\Fixture;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;

#[AsCommand(name: 'app:some')]
final class DescriptionWithNameOnExistingAttributeCommand extends Command
{
    protected function configure(): void
    {
        $this->setDescription('Some description');
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Symfony61\Rector\Class_\CommandConfigureToAttributeRector\Fixture;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;

#[AsCommand(name: 'app:some', description: 'Some description')]
final class DescriptionWithNameOnExistingAttributeCommand extends Command
{
}

?>
