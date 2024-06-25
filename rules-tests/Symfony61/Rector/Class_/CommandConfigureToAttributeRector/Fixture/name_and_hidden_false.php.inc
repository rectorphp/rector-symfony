<?php

namespace Rector\Symfony\Tests\Symfony61\Rector\Class_\CommandConfigureToAttributeRector\Fixture;

final class NameAndHiddenFalse extends \Symfony\Component\Console\Command\Command
{
    public function configure()
    {
        $this->setHidden(false);
        $this->setName('sunshine');
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Symfony61\Rector\Class_\CommandConfigureToAttributeRector\Fixture;

#[\Symfony\Component\Console\Attribute\AsCommand(name: 'sunshine', hidden: false)]
final class NameAndHiddenFalse extends \Symfony\Component\Console\Command\Command
{
    public function configure()
    {
    }
}

?>
