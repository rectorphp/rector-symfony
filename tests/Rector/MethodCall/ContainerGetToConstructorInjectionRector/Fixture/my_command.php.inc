<?php

namespace Rector\Symfony\Tests\Rector\MethodCall\ContainerGetToConstructorInjectionRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class MyCommand extends ContainerAwareCommand
{
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $someService = $this->getContainer()->get('some_service');
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Rector\MethodCall\ContainerGetToConstructorInjectionRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class MyCommand extends ContainerAwareCommand
{
    public function __construct(private \stdClass $stdClass)
    {
        parent::__construct();
    }
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $someService = $this->stdClass;
    }
}

?>
