<?php

namespace Rector\Symfony\Tests\Rector\MethodCall\ContainerGetToConstructorInjectionRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class TwigExtensionUnderscore extends AbstractController
{
    public function run()
    {
        $twigExtension = $this->get('twig_extension');
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Rector\MethodCall\ContainerGetToConstructorInjectionRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class TwigExtensionUnderscore extends AbstractController
{
    public function __construct(private \Twig_Extension $twigExtension)
    {
    }
    public function run()
    {
        $twigExtension = $this->twigExtension;
    }
}

?>
