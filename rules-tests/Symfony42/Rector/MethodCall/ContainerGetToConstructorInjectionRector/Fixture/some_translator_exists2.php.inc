<?php

namespace Rector\Symfony\Tests\Symfony42\Rector\MethodCall\ContainerGetToConstructorInjectionRector\Fixture;

use Rector\Symfony\Tests\Symfony42\Rector\MethodCall\AbstractToConstructorInjectionRectorSource\SomeTranslator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class SomeTranslatorExists extends AbstractController
{
    private SomeTranslator $someTranslator;

    public function __construct(SomeTranslator $someTranslator)
    {
        $this->someTranslator = $someTranslator;
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
    private SomeTranslator $someTranslator;

    public function __construct(SomeTranslator $someTranslator)
    {
        $this->someTranslator = $someTranslator;
    }

    protected function execute()
    {
        $someService = $this->someTranslator;

        $someService = $this->someTranslator->translateSomething();
    }
}

?>
