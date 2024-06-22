<?php

namespace Rector\Symfony\Tests\Symfony61\Rector\Class_\CommandConfigureToAttributeRector\Fixture;

final class NameAndDescriptionFluent extends \Symfony\Component\Console\Command\Command
{
    public function configure()
    {
        $this->setName('sunshine')
            ->setDescription('rising above');
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Symfony61\Rector\Class_\CommandConfigureToAttributeRector\Fixture;

#[\Symfony\Component\Console\Attribute\AsCommand(name: 'sunshine', description: 'rising above')]
final class NameAndDescriptionFluent extends \Symfony\Component\Console\Command\Command
{
    public function configure()
    {
    }
}

?>
