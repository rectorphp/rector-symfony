<?php

declare(strict_types=1);
namespace Rector\Symfony\Tests\Rector\Class_\InvokableControllerRector\FixtureSplit;

final class SomeListController extends \Symfony\Bundle\FrameworkBundle\Controller\Controller
{
    public function __invoke()
    {
        echo 2;
    }
}
