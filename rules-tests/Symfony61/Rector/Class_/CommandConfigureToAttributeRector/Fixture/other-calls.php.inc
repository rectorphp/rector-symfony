<?php

namespace Rector\Symfony\Tests\Symfony61\Rector\Class_\CommandConfigureToAttributeRector\Fixture;

final class OtherCalls extends \Symfony\Component\Console\Command\Command
{
    public function configure()
    {
        $this->setName('sunshine')
            ->setAliases(['first', 'second'])
            ->addArgument('argument name');
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Symfony61\Rector\Class_\CommandConfigureToAttributeRector\Fixture;

#[\Symfony\Component\Console\Attribute\AsCommand(name: 'sunshine', aliases: ['first', 'second'])]
final class OtherCalls extends \Symfony\Component\Console\Command\Command
{
    public function configure()
    {
        $this
            ->addArgument('argument name');
    }
}

?>
