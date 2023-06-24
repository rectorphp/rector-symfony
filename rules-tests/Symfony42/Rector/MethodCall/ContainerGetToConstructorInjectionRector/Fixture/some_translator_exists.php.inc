<?php

namespace Rector\Symfony\Tests\Symfony42\Rector\MethodCall\ContainerGetToConstructorInjectionRector\Fixture;

use Rector\Symfony\Tests\Symfony42\Rector\MethodCall\AbstractToConstructorInjectionRectorSource\SomeTranslator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class SomeTranslatorExists extends AbstractController
{
    public function __construct(private readonly SomeTranslator $someTranslator)
    {
    }

    protected function execute()
    {
        $someService = $this->getContainer()->get('translator');

        $someService = $this->getContainer()->get('translator')->translateSomething();
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Symfony42\Rector\MethodCall\ContainerGetToConstructorInjectionRector\Fixture;

use Rector\Symfony\Tests\Symfony42\Rector\MethodCall\AbstractToConstructorInjectionRectorSource\SomeTranslator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class SomeTranslatorExists extends AbstractController
{
    public function __construct(private readonly SomeTranslator $someTranslator)
    {
    }

    protected function execute()
    {
        $someService = $this->someTranslator;

        $someService = $this->someTranslator->translateSomething();
    }
}

?>
