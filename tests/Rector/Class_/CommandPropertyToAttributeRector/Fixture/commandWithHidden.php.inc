<?php

namespace Rector\Symfony\Tests\Rector\Class_\CommandPropertyToAttributeRector\Fixture;

class CommandWithHidden extends \Symfony\Component\Console\Command\Command
{
    /** @var string|null */
    public static $defaultName = 'sunshine';

    public function configure(): void
    {
        $this
            ->setHidden();
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Rector\Class_\CommandPropertyToAttributeRector\Fixture;

#[\Symfony\Component\Console\Attribute\AsCommand('sunshine', null, [], true)]
class CommandWithHidden extends \Symfony\Component\Console\Command\Command
{
    public function configure(): void
    {
    }
}

?>
