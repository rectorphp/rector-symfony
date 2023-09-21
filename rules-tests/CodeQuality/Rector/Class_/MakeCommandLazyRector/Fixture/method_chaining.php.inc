<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\MakeCommandLazyRector\Fixture;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MethodChainingCommand extends \Symfony\Component\Console\Command\Command
{
    public function configure()
    {
        $this
            ->setName('app:method_chaining')
            ->setDescription('some description');
    }

    protected function execute(InputInterface $input, OutputInterface $output) {}
}

?>
-----
<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\MakeCommandLazyRector\Fixture;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MethodChainingCommand extends \Symfony\Component\Console\Command\Command
{
    protected static $defaultName = 'app:method_chaining';
    public function configure()
    {
        $this
            ->setDescription('some description');
    }

    protected function execute(InputInterface $input, OutputInterface $output) {}
}

?>
