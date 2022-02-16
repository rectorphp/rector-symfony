<?php

namespace Rector\Symfony\Tests\Rector\MethodCall\RedirectToRouteRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

final class GenerateUrlWithRelative extends AbstractController
{
    public function someAction()
    {
        return $this->redirect(
            $this->generateUrl('something', [], UrlGeneratorInterface::RELATIVE_PATH)
        );
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Rector\MethodCall\RedirectToRouteRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

final class GenerateUrlWithRelative extends AbstractController
{
    public function someAction()
    {
        return $this->redirectToRoute('something', []);
    }
}

?>
