<?php

namespace Rector\Symfony\Tests\Rector\MethodCall\ContainerGetToConstructorInjectionRector\Fixture;

use Rector\Symfony\Tests\Rector\MethodCall\ContainerGetToConstructorInjectionRector\Source\SomeTranslator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class SomeTranslatorDifferentObject extends AbstractController
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

namespace Rector\Symfony\Tests\Rector\MethodCall\ContainerGetToConstructorInjectionRector\Fixture;

use Rector\Symfony\Tests\Rector\MethodCall\ContainerGetToConstructorInjectionRector\Source\SomeTranslator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class SomeTranslatorDifferentObject extends AbstractController
{
    private SomeTranslator $someTranslator;

    public function __construct(SomeTranslator $someTranslator, private \Rector\Symfony\Tests\Rector\MethodCall\AbstractToConstructorInjectionRectorSource\SomeTranslator $someTranslator2)
    {
        $this->someTranslator = $someTranslator;
    }

    protected function execute()
    {
        $someService = $this->someTranslator2;

        $someService = $this->someTranslator2->translateSomething();
    }
}

?>
