<?php

namespace Rector\Symfony\Tests\Rector\Class_\CommandPropertyToAttributeRector\Fixture;

class CommandWithHiddenTrue extends \Symfony\Component\Console\Command\Command
{
    /** @var string|null */
    public static $defaultName = 'sunshine';

    public function configure(): void
    {
        $this
            ->setHidden(true);
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Rector\Class_\CommandPropertyToAttributeRector\Fixture;

#[\Symfony\Component\Console\Attribute\AsCommand('sunshine', null, [], true)]
class CommandWithHiddenTrue extends \Symfony\Component\Console\Command\Command
{
    public function configure(): void
    {
    }
}

?>
