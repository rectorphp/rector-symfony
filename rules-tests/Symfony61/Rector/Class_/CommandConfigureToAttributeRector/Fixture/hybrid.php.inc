<?php

namespace Rector\Symfony\Tests\Symfony61\Rector\Class_\CommandConfigureToAttributeRector\Fixture;

#[\Symfony\Component\Console\Attribute\AsCommand(name: 'sunshine')]
final class Hybrid extends \Symfony\Component\Console\Command\Command
{
    public function configure()
    {
        $this->setDescription('rising above');
        $this->setAliases(['first', 'second']);
        $this->setHidden(true);
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Symfony61\Rector\Class_\CommandConfigureToAttributeRector\Fixture;

#[\Symfony\Component\Console\Attribute\AsCommand(name: 'sunshine', description: 'rising above', aliases: ['first', 'second'], hidden: true)]
final class Hybrid extends \Symfony\Component\Console\Command\Command
{
    public function configure()
    {
    }
}

?>
