<?php

namespace Rector\Symfony\Tests\Symfony53\Rector\Class_\CommandDescriptionToPropertyRector\Fixture;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SetDescriptionAtTop extends \Symfony\Component\Console\Command\Command
{
    public function configure()
    {
        $this
            ->setName('some:command')
            ->setDescription('Last description');
    }

    protected function initialize(InputInterface $input, OutputInterface $output): void
    {
        parent::initialize($input, $output);
    }

     protected function execute(InputInterface $input, OutputInterface $output): int
    {
        return 0;
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Symfony53\Rector\Class_\CommandDescriptionToPropertyRector\Fixture;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SetDescriptionAtTop extends \Symfony\Component\Console\Command\Command
{
    protected static $defaultDescription = 'Last description';
    public function configure()
    {
        $this
            ->setName('some:command');
    }

    protected function initialize(InputInterface $input, OutputInterface $output): void
    {
        parent::initialize($input, $output);
    }

     protected function execute(InputInterface $input, OutputInterface $output): int
    {
        return 0;
    }
}

?>
