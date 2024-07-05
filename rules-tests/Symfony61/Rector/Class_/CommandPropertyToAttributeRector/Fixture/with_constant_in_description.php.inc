<?php

namespace Rector\Symfony\Tests\Symfony61\Rector\Class_\CommandPropertyToAttributeRector\Fixture;

class WithConstantInDescription extends \Symfony\Component\Console\Command\Command
{
    private const DESCRIPTION = 'description';

    /** @var string|null */
    public static $defaultName = 'any name';

    /** @var string|null */
    public static $defaultDescription = self::DESCRIPTION;
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Symfony61\Rector\Class_\CommandPropertyToAttributeRector\Fixture;

#[\Symfony\Component\Console\Attribute\AsCommand(name: 'any name', description: self::DESCRIPTION)]
class WithConstantInDescription extends \Symfony\Component\Console\Command\Command
{
    private const DESCRIPTION = 'description';
}

?>
