<?php

namespace Rector\Symfony\Tests\Rector\Class_\CommandPropertyToAttributeRector\Fixture;

class CommandWithAliases extends \Symfony\Component\Console\Command\Command
{
    /** @var string|null */
    public static $defaultName = 'sunshine';

    public function configure(): void
    {
        $this
            ->setAliases(['sun', 'shine']);
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Rector\Class_\CommandPropertyToAttributeRector\Fixture;

#[\Symfony\Component\Console\Attribute\AsCommand('sunshine', null, ['sun', 'shine'])]
class CommandWithAliases extends \Symfony\Component\Console\Command\Command
{
    public function configure(): void
    {
    }
}

?>
