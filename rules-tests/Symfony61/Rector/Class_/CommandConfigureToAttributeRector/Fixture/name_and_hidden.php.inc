<?php

namespace Rector\Symfony\Tests\Symfony61\Rector\Class_\CommandConfigureToAttributeRector\Fixture;

final class NameAndHidden extends \Symfony\Component\Console\Command\Command
{
    public function configure()
    {
        $this->setName('sunshine');
        $this->setAliases(['first', 'second'])
            ->setHidden(true);
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Symfony61\Rector\Class_\CommandConfigureToAttributeRector\Fixture;

#[\Symfony\Component\Console\Attribute\AsCommand(name: 'sunshine', aliases: ['first', 'second'], hidden: true)]
final class NameAndHidden extends \Symfony\Component\Console\Command\Command
{
    public function configure()
    {
    }
}

?>
