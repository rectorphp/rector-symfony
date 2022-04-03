<?php

namespace Rector\Symfony\Tests\Rector\ClassMethod\ParamTypeFromRouteRequiredRegexRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

final class SomeController extends Controller
{
    /**
     * @Route(
     *     requirements={"number"="\d+"},
     * )
     */
    public function detailAction($number)
    {
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Rector\ClassMethod\ParamTypeFromRouteRequiredRegexRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

final class SomeController extends Controller
{
    /**
     * @Route(
     *     requirements={"number"="\d+"},
     * )
     */
    public function detailAction(int $number)
    {
    }
}

?>
