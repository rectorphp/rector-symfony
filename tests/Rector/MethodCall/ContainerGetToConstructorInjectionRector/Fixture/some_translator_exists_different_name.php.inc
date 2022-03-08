<?php

namespace Rector\Symfony\Tests\Rector\MethodCall\ContainerGetToConstructorInjectionRector\Fixture;

use Rector\Symfony\Tests\Rector\MethodCall\AbstractToConstructorInjectionRectorSource\SomeTranslator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class SomeTranslatorExistsDifferentName extends AbstractController
{
    public function __construct(private readonly SomeTranslator $this_is_a_translator)
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

namespace Rector\Symfony\Tests\Rector\MethodCall\ContainerGetToConstructorInjectionRector\Fixture;

use Rector\Symfony\Tests\Rector\MethodCall\AbstractToConstructorInjectionRectorSource\SomeTranslator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class SomeTranslatorExistsDifferentName extends AbstractController
{
    public function __construct(private readonly SomeTranslator $this_is_a_translator)
    {
    }

    protected function execute()
    {
        $someService = $this->this_is_a_translator;

        $someService = $this->this_is_a_translator->translateSomething();
    }
}

?>
