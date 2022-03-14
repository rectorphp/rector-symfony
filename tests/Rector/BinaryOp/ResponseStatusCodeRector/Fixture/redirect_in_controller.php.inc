<?php

namespace Rector\Symfony\Tests\Rector\BinaryOp\ResponseStatusCodeRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

final class RedirectInController extends Controller
{
    public function index()
    {
        $this->redirect('some_url', 404);
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Rector\BinaryOp\ResponseStatusCodeRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

final class RedirectInController extends Controller
{
    public function index()
    {
        $this->redirect('some_url', \Symfony\Component\HttpFoundation\Response::HTTP_NOT_FOUND);
    }
}

?>
