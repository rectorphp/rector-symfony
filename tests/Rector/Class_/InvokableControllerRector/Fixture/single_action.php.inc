<?php

namespace Rector\Symfony\Tests\Rector\Class_\InvokableControllerRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

final class SingleAction extends Controller
{
    public function listAction()
    {
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Rector\Class_\InvokableControllerRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

final class SingleAction extends Controller
{
    public function __invoke()
    {
    }
}

?>
