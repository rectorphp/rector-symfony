<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\ClassMethod\ParamTypeFromRouteRequiredRegexRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

final class MultipleParams extends Controller
{
    /**
     * @Route(
     *     requirements={"siteId"="\d+", "locationId"="%location_id_regex%", "categoryId"="\d+"},
     * )
     */
    public function __invoke($siteId, $locationId, $categoryId)
    {
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\ClassMethod\ParamTypeFromRouteRequiredRegexRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

final class MultipleParams extends Controller
{
    /**
     * @Route(
     *     requirements={"siteId"="\d+", "locationId"="%location_id_regex%", "categoryId"="\d+"},
     * )
     */
    public function __invoke(int $siteId, string $locationId, int $categoryId)
    {
    }
}

?>
