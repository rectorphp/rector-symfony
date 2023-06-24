<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\ClassMethod\ParamTypeFromRouteRequiredRegexRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

final class WithFallbackValue extends Controller
{
    /**
     * @Route(
     *     requirements={"isOn"="(y|n)"}
     * )
     */
    public function detailAction($isOn)
    {
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\ClassMethod\ParamTypeFromRouteRequiredRegexRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

final class WithFallbackValue extends Controller
{
    /**
     * @Route(
     *     requirements={"isOn"="(y|n)"}
     * )
     */
    public function detailAction(string $isOn)
    {
    }
}

?>
