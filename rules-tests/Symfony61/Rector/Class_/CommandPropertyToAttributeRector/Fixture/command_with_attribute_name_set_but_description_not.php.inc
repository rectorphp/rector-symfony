<?php

namespace Rector\Symfony\Tests\Symfony61\Rector\Class_\CommandPropertyToAttributeRector\Fixture;

#[\Symfony\Component\Console\Attribute\AsCommand('sunshine')]
class CommandWithAttributeNameSetButDescriptionNot extends \Symfony\Component\Console\Command\Command
{
    /** @var string|null */
    public static $defaultDescription = 'sunshine command';

}

?>
-----
<?php

namespace Rector\Symfony\Tests\Symfony61\Rector\Class_\CommandPropertyToAttributeRector\Fixture;

#[\Symfony\Component\Console\Attribute\AsCommand('sunshine', 'sunshine command')]
class CommandWithAttributeNameSetButDescriptionNot extends \Symfony\Component\Console\Command\Command
{
}

?>
