<?php

namespace Rector\Symfony\Tests\Rector\Class_\CommandPropertyToAttributeRector\Fixture;

class SunshineCommand extends \Symfony\Component\Console\Command\Command
{
    /** @var string|null */
    public static $defaultName = 'sunshine';
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Rector\Class_\CommandPropertyToAttributeRector\Fixture;

#[\Symfony\Component\Console\Attribute\AsCommand('sunshine')]
class SunshineCommand extends \Symfony\Component\Console\Command\Command
{
}

?>
