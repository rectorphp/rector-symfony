<?php

namespace Rector\Symfony\Tests\Symfony61\Rector\Class_\CommandPropertyToAttributeRector\Fixture;

class SunshineCommand extends \Symfony\Component\Console\Command\Command
{
    /** @var string|null */
    public static $defaultName = 'sunshine';

    /** @var string|null */
    public static $defaultDescription = 'Let the sun shine!';
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Symfony61\Rector\Class_\CommandPropertyToAttributeRector\Fixture;

#[\Symfony\Component\Console\Attribute\AsCommand(name: 'sunshine', description: 'Let the sun shine!')]
class SunshineCommand extends \Symfony\Component\Console\Command\Command
{
}

?>
