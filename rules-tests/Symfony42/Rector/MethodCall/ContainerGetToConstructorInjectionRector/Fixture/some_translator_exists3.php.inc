<?php

namespace Rector\Symfony\Tests\Symfony42\Rector\MethodCall\ContainerGetToConstructorInjectionRector\Fixture;

use Rector\Symfony\Tests\Symfony42\Rector\MethodCall\AbstractToConstructorInjectionRectorSource\SomeTranslator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class SomeTranslatorExists3 extends AbstractController
{
    private SomeTranslator $someTranslator;
    private SomeTranslator $someTranslator2;

    public function __construct(SomeTranslator $someTranslator, SomeTranslator $someTranslator2)
    {
        $this->someTranslator = $someTranslator;
        $this->someTranslator2 = $someTranslator2;
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

final class SomeTranslatorExists3 extends AbstractController
{
    private SomeTranslator $someTranslator;
    private SomeTranslator $someTranslator2;

    public function __construct(SomeTranslator $someTranslator, SomeTranslator $someTranslator2)
    {
        $this->someTranslator = $someTranslator;
        $this->someTranslator2 = $someTranslator2;
    }

    protected function execute()
    {
        $someService = $this->someTranslator;

        $someService = $this->someTranslator->translateSomething();
    }
}

?>
