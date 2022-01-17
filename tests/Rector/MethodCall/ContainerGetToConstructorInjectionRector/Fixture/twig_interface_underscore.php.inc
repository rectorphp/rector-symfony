<?php

namespace Rector\Symfony\Tests\Rector\MethodCall\ContainerGetToConstructorInjectionRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class TwigInterfaceUnderscore extends AbstractController
{
    public function run()
    {
        $twigExtension = $this->get('twig_extension_interface');
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Rector\MethodCall\ContainerGetToConstructorInjectionRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class TwigInterfaceUnderscore extends AbstractController
{
    public function __construct(private \Twig_ExtensionInterface $twigExtension)
    {
    }
    public function run()
    {
        $twigExtension = $this->twigExtension;
    }
}

?>
