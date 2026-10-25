<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\ClassMethod\RequestQueryToMapQueryParameterRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

final class SkipUnsupportedGetterController extends AbstractController
{
    public function run(Request $request): void
    {
        $raw = $request->query->get('raw');
        $digits = $request->query->getDigits('digits');
        $id = $request->attributes->getInt('id');
    }
}

?>
