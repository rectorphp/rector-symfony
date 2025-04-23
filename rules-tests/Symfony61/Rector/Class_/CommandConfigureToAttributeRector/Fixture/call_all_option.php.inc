<?php

namespace Rector\Symfony\Tests\Symfony61\Rector\Class_\CommandConfigureToAttributeRector\Fixture;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

final class CallAllOptions extends \Symfony\Component\Console\Command\Command
{
    public function configure()
    {
        $this->setName('sunshine')
            ->setDescription('Some description')
            ->setHidden(false)
            ->setHelp('Some help text')
            ->addArgument('argument name')
            ->addOption('option', 'o', InputOption::VALUE_NONE, 'Option description')
            ->setAliases(['first', 'second']);
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Symfony61\Rector\Class_\CommandConfigureToAttributeRector\Fixture;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

#[\Symfony\Component\Console\Attribute\AsCommand(name: 'sunshine', description: 'Some description', aliases: ['first', 'second'], hidden: false)]
final class CallAllOptions extends \Symfony\Component\Console\Command\Command
{
    public function configure()
    {
        $this
            ->setHelp('Some help text')
            ->addArgument('argument name')
            ->addOption('option', 'o', InputOption::VALUE_NONE, 'Option description');
    }
}

?>
