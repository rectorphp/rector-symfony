<?php

namespace Rector\Symfony\Tests\DowngradeSymfony70\Rector\Class_\DowngradeSymfonyCommandAttributeRector\Fixture;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;

#[AsCommand(name: 'app:create-user', description: 'some description')]
class WithNameAndDescription extends Command
{
}

?>
-----
<?php

namespace Rector\Symfony\Tests\DowngradeSymfony70\Rector\Class_\DowngradeSymfonyCommandAttributeRector\Fixture;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;

#[AsCommand(name: 'app:create-user', description: 'some description')]
class WithNameAndDescription extends Command
{
    protected function configure()
    {
        $this->setName('app:create-user');
        $this->setDescription('some description');
    }
}

?>
