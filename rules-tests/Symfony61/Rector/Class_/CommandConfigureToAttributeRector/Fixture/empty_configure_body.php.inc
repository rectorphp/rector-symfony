<?php

namespace Rector\Symfony\Tests\Symfony61\Rector\Class_\CommandConfigureToAttributeRector\Fixture;

final class EmptyConfigureBody extends \Symfony\Component\Console\Command\Command
{
    protected function configure(): void
    {
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Symfony61\Rector\Class_\CommandConfigureToAttributeRector\Fixture;

final class EmptyConfigureBody extends \Symfony\Component\Console\Command\Command
{
}

?>
