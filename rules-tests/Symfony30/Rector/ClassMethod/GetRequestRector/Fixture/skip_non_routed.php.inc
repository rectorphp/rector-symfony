<?php declare (strict_types=1);

namespace Rector\Symfony\Tests\Symfony30\Rector\ClassMethod\GetRequestRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

final class SkipNonRouted extends Controller
{
    public function someAction()
    {
        $this->getRequest()->getSomething();
    }
}
