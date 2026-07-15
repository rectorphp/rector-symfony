<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\CodeQuality\Rector\ClassMethod\ResponseReturnTypeControllerActionRector\Source;

use Symfony\Component\HttpFoundation\Response;

/**
 * Mimics FOS\RestBundle\Controller\ControllerTrait
 */
trait ControllerTrait
{
    /**
     * @return View
     */
    protected function view($data = null, ?int $statusCode = null, array $headers = [])
    {
        return View::create($data, $statusCode, $headers);
    }

    /**
     * @return Response
     */
    protected function handleView(View $view)
    {
        return new Response();
    }
}
