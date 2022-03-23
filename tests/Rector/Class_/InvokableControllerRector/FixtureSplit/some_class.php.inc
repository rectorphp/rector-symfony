<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\Rector\Class_\InvokableControllerRector\FixtureSplit;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

final class SomeController extends Controller
{
    public function detailAction()
    {
        echo 1;
    }

    public function listAction()
    {
        echo 2;
    }
}
