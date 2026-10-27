<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\ClassMethod\RequestQueryToMapQueryParameterRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

final class SkipDynamicNameAndDefaultController extends AbstractController
{
    public function run(Request $request, string $name, int $defaultPage): void
    {
        $value = $request->query->getInt($name);
        $page = $request->query->getInt('page', $defaultPage);
        $other = $request->query->getInt(key: 'other');
    }
}

?>
