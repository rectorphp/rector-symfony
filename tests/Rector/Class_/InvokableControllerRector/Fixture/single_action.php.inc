<?php

declare(strict_types=1);

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

declare(strict_types=1);

namespace Rector\Symfony\Tests\Rector\Class_\InvokableControllerRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

final class SingleAction extends Controller
{
    public function __invoke()
    {
    }
}

?>
