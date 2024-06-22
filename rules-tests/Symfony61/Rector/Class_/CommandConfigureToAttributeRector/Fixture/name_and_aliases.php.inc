<?php

namespace Rector\Symfony\Tests\Symfony61\Rector\Class_\CommandConfigureToAttributeRector\Fixture;

final class NameAndAliases extends \Symfony\Component\Console\Command\Command
{
    public function configure()
    {
        $this->setName('sunshine');
        $this->setAliases(['first', 'second']);
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Symfony61\Rector\Class_\CommandConfigureToAttributeRector\Fixture;

#[\Symfony\Component\Console\Attribute\AsCommand(name: 'sunshine', aliases: ['first', 'second'])]
final class NameAndAliases extends \Symfony\Component\Console\Command\Command
{
    public function configure()
    {
    }
}

?>
