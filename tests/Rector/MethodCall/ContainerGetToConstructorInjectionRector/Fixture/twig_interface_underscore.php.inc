<?php

namespace Rector\Symfony\Tests\Rector\MethodCall\ContainerGetToConstructorInjectionRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class TwigInterfaceUnderscore extends AbstractController
{
    public function run()
    {
        $twigExtension = $this->get('specific_twig_extension');
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Rector\MethodCall\ContainerGetToConstructorInjectionRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class TwigInterfaceUnderscore extends AbstractController
{
    public function __construct(private \Rector\Symfony\Tests\Rector\MethodCall\ContainerGetToConstructorInjectionRector\Source\SpecificTwigExtension $specificTwigExtension)
    {
    }
    public function run()
    {
        $twigExtension = $this->specificTwigExtension;
    }
}

?>
