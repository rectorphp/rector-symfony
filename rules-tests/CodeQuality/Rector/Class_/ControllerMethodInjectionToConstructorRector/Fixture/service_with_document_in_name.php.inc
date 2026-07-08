<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\ControllerMethodInjectionToConstructorRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

final class ServiceWithDocumentInName extends AbstractController
{
    #[Route('/some-action', name: 'some_action')]
    public function someAction(
        \Symfony\Component\HttpFoundation\Request $request,
        \App\Service\DocumentService $documentService
    ) {
        $documentService->process();
    }
}

?>
-----
<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\ControllerMethodInjectionToConstructorRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

final class ServiceWithDocumentInName extends AbstractController
{
    public function __construct(private readonly \App\Service\DocumentService $documentService)
    {
    }
    #[Route('/some-action', name: 'some_action')]
    public function someAction(
        \Symfony\Component\HttpFoundation\Request $request
    ) {
        $this->documentService->process();
    }
}

?>
