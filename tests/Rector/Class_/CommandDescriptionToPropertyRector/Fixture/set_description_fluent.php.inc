<?php

namespace Rector\Symfony\Tests\Rector\Class_\MakeCommandLazyRector\Fixture;

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

namespace Rector\Symfony\Tests\Rector\Class_\MakeCommandLazyRector\Fixture;

class SetDescriptionFluent extends \Symfony\Component\Console\Command\Command
{
    protected static $defaultName = 'some:command';
    protected static $defaultDescription = 'Description';
    public function configure()
    {
    }
}

?>
