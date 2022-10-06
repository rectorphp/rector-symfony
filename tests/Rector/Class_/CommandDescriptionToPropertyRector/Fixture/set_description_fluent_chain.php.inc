<?php

namespace Rector\Symfony\Tests\Rector\Class_\CommandDescriptionToPropertyRector\Fixture;

class SetDescriptionFluentChain extends \Symfony\Component\Console\Command\Command
{
    protected static $defaultName = 'some:command';
    public function configure()
    {
        $this
            ->setDescription('Description')
            ->setHelp('help me pls!!!');
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Rector\Class_\CommandDescriptionToPropertyRector\Fixture;

class SetDescriptionFluentChain extends \Symfony\Component\Console\Command\Command
{
    protected static $defaultName = 'some:command';
    protected static $defaultDescription = 'Description';
    public function configure()
    {
        $this->setHelp('help me pls!!!');
    }
}

?>
