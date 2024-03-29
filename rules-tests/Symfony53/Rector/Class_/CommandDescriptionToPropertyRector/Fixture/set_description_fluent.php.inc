<?php

namespace Rector\Symfony\Tests\Symfony53\Rector\Class_\CommandDescriptionToPropertyRector\Fixture;

class SetDescriptionFluent extends \Symfony\Component\Console\Command\Command
{
    protected static $defaultName = 'some:command';
    public function configure()
    {
        $this
            ->setDescription('Description');
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Symfony53\Rector\Class_\CommandDescriptionToPropertyRector\Fixture;

class SetDescriptionFluent extends \Symfony\Component\Console\Command\Command
{
    protected static $defaultName = 'some:command';
    protected static $defaultDescription = 'Description';
    public function configure()
    {
    }
}

?>
