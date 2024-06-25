<?php

namespace Rector\Symfony\Tests\Symfony61\Rector\Class_\CommandConfigureToAttributeRector\Fixture;

final class OtherCallsMiddle extends \Symfony\Component\Console\Command\Command
{
    public function configure()
    {
        $this->setName('sunshine')
            ->addArgument('argument name')
            ->setAliases(['first', 'second']);
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Symfony61\Rector\Class_\CommandConfigureToAttributeRector\Fixture;

#[\Symfony\Component\Console\Attribute\AsCommand(name: 'sunshine', aliases: ['first', 'second'])]
final class OtherCallsMiddle extends \Symfony\Component\Console\Command\Command
{
    public function configure()
    {
        $this
            ->addArgument('argument name');
    }
}

?>
