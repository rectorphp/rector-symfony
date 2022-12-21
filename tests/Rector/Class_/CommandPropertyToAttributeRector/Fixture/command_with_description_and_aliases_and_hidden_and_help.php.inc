<?php

namespace Rector\Symfony\Tests\Rector\Class_\CommandPropertyToAttributeRector\Fixture;

class CommandWithDescriptionAndAliasesAndHiddenAndHelp extends \Symfony\Component\Console\Command\Command
{
    /** @var string|null */
    public static $defaultName = 'sunshine';

    /** @var string|null */
    public static $defaultDescription = 'Let the sun shine!';

    public function configure(): void
    {
        $this
            ->setAliases(['sun', 'shine'])
            ->setHidden(false)
            ->setHelp('Let the sun shine! Its that simple')
        ;
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Rector\Class_\CommandPropertyToAttributeRector\Fixture;

#[\Symfony\Component\Console\Attribute\AsCommand('sunshine', 'Let the sun shine!', ['sun', 'shine'], false)]
class CommandWithDescriptionAndAliasesAndHiddenAndHelp extends \Symfony\Component\Console\Command\Command
{
    public function configure(): void
    {
        $this
            ->setHelp('Let the sun shine! Its that simple')
        ;
    }
}

?>
