<?php

namespace Rector\Symfony\Tests\Rector\Class_\CommandPropertyToAttributeRector\Fixture;

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

namespace Rector\Symfony\Tests\Rector\Class_\CommandPropertyToAttributeRector\Fixture;

#[\Symfony\Component\Console\Attribute\AsCommand('sunshine', 'Let the sun shine!')]
class SunshineCommand extends \Symfony\Component\Console\Command\Command
{
}

?>
