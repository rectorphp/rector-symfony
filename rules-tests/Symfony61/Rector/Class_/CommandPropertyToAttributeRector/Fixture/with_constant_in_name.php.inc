<?php

namespace Rector\Symfony\Tests\Symfony61\Rector\Class_\CommandPropertyToAttributeRector\Fixture;

class WithConstantInName extends \Symfony\Component\Console\Command\Command
{
    private const NAME = 'infix';

    /** @var string|null */
    public static $defaultName = 'start' . self::INVALID;
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Symfony61\Rector\Class_\CommandPropertyToAttributeRector\Fixture;

#[\Symfony\Component\Console\Attribute\AsCommand(name: 'start' . self::INVALID)]
class WithConstantInName extends \Symfony\Component\Console\Command\Command
{
    private const NAME = 'infix';
}

?>
