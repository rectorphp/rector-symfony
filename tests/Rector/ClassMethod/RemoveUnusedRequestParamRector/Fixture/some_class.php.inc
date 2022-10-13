<?php

namespace Rector\Symfony\Tests\Rector\ClassMethod\RemoveUnusedRequestParamRector\Fixture;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

final class SomeController extends Controller
{
    public function run(Request $request, int $id)
    {
        echo $id;
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Rector\ClassMethod\RemoveUnusedRequestParamRector\Fixture;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

final class SomeController extends Controller
{
    public function run(int $id)
    {
        echo $id;
    }
}

?>
