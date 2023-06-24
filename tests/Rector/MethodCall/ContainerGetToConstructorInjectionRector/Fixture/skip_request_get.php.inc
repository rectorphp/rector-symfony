<?php

namespace Rector\Symfony\Tests\Rector\MethodCall\ContainerGetToConstructorInjectionRector\Fixture;

use Rector\Symfony\Tests\Rector\MethodCall\ContainerGetToConstructorInjectionRector\Source\SomeTranslator;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

final class SkipRequestGet extends Controller
{
    protected function execute(Request $request)
    {
        $result = $request->get((string) SomeTranslator::class);
    }
}
