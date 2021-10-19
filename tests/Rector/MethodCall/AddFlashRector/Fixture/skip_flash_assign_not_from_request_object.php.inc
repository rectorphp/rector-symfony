<?php

namespace Rector\Symfony\Tests\Rector\MethodCall\AddFlashRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

final class SkipFlashAssignNotFromRequestObject extends Controller
{
    public function run()
    {
        $session = $this->get('session');
        $session->getFlashBag()->add('warning', 'Provided card doesn\'t belong to you');
    }
}