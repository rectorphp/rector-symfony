<?php

namespace Rector\Symfony\Tests\Symfony73\Rector\Class_\CommandDefaultNameAndDescriptionToAsCommandAttributeRector\Fixture;

use Symfony\Component\Console\Command\Command;

final class SomeCommandWithDefaults extends Command
{
    public static function getDefaultName(): string
    {
        return 'app:some-command';
    }

    public static function getDefaultDescription(): string
    {
        return 'This is some command description';
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Symfony73\Rector\Class_\CommandDefaultNameAndDescriptionToAsCommandAttributeRector\Fixture;

use Symfony\Component\Console\Command\Command;

#[\Symfony\Component\Console\Attribute\AsCommand(name: 'app:some-command', description: 'This is some command description')]
final class SomeCommandWithDefaults extends Command
{
}

?>
