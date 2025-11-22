<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\ControllerMethodInjectionToConstructorRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

/**
 * Entity or Document can be detected via ValueResolver that query in ValueResolver services
 */
final class SkipNamespacedDocumentOrEntity extends AbstractController
{
    public function someAction(Request $request, \App\Entity\SomeEntity $entity)
    {
    }

    public function some2Action(Request $request, \App\Document\SomeEntity $document)
    {
    }
}
