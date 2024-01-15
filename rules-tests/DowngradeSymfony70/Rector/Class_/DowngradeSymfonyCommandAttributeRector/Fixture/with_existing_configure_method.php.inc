<?php

namespace Rector\Symfony\Tests\DowngradeSymfony70\Rector\Class_\DowngradeSymfonyCommandAttributeRector\Fixture;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;

#[AsCommand(name: 'app:create-user')]
class WithExistingConfigureMethod extends Command
{
    protected function configure()
    {
        echo 'test';
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\DowngradeSymfony70\Rector\Class_\DowngradeSymfonyCommandAttributeRector\Fixture;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;

class WithExistingConfigureMethod extends Command
{
    protected function configure()
    {
        echo 'test';
        $this->setName('app:create-user');
    }
}

?>
