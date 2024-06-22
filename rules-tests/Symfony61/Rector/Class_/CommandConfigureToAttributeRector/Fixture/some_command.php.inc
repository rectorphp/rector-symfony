<?php

namespace Rector\Symfony\Tests\Symfony61\Rector\Class_\CommandConfigureToAttributeRector\Fixture;

final class SomeCommand extends \Symfony\Component\Console\Command\Command
{
    public function configure()
    {
        $this->setName('sunshine');
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Symfony61\Rector\Class_\CommandConfigureToAttributeRector\Fixture;

#[\Symfony\Component\Console\Attribute\AsCommand('sunshine')]
final class SomeCommand extends \Symfony\Component\Console\Command\Command
{
}

?>
