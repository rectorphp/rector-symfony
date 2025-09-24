<?php

namespace Rector\Symfony\Tests\Symfony61\Rector\Class_\CommandConfigureToAttributeRector\Fixture;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;

#[AsCommand(
    name: 'app:accounting',
    description: 'accounting',
)]
class DoNotReAddToAttributeWhenExists extends Command
{

    protected function configure(): void
    {
        parent::configure();

        $this->setName('app:accounting')
            ->setDescription('accounting')
        ;
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Symfony61\Rector\Class_\CommandConfigureToAttributeRector\Fixture;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;

#[AsCommand(
    name: 'app:accounting',
    description: 'accounting',
)]
class DoNotReAddToAttributeWhenExists extends Command
{

    protected function configure(): void
    {
        parent::configure();
    }
}

?>
