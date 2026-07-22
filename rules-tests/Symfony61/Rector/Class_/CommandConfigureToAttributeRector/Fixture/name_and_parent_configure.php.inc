<?php

namespace Rector\Symfony\Tests\Symfony61\Rector\Class_\CommandConfigureToAttributeRector\Fixture;

final class NameAndParentConfigure extends \Symfony\Component\Console\Command\Command
{
    protected function configure(): void
    {
        $this->setName('mautic:fake:command');

        parent::configure();
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Symfony61\Rector\Class_\CommandConfigureToAttributeRector\Fixture;

#[\Symfony\Component\Console\Attribute\AsCommand(name: 'mautic:fake:command')]
final class NameAndParentConfigure extends \Symfony\Component\Console\Command\Command
{
}

?>
