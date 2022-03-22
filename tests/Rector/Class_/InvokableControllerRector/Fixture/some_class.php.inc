<?php

namespace Rector\Symfony\Tests\Rector\Class_\InvokableControllerRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

final class SomeController extends Controller
{
    public function detailAction()
    {
    }

    public function listAction()
    {
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Rector\Class_\InvokableControllerRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

final class SomeDetailController extends Controller
{
    public function __invoke()
    {
    }
}

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

final class SomeListController extends Controller
{
    public function __invoke()
    {
    }
}

?>
