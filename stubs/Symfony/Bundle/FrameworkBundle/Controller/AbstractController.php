<?php

declare(strict_types=1);

namespace Symfony\Bundle\FrameworkBundle\Controller;

use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpFoundation\StreamedResponse;

if (class_exists('Symfony\Bundle\FrameworkBundle\Controller\AbstractController')) {
    return;
}

abstract class AbstractController implements \Symfony\Component\DependencyInjection\ContainerInterface
{
    public function getDoctrine(): ManagerRegistry
    {
    }

    public function getContainer(): \Symfony\Component\DependencyInjection\ContainerInterface
    {
    }

    public function render($templateName, $params = []): Response
    {
    }

    public function renderForm(string $view, array $parameters = [], Response $response = null): Response
    {
    }

    public function forward(string $controller, array $path = [], array $query = []): Response
    {
    }

    public function redirect(string $url, int $status = 302): RedirectResponse
    {
    }

    public function redirectToRoute($routeName): RedirectResponse
    {
    }

    public function json($data, int $status = 200, array $headers = [], array $context = []): JsonResponse
    {
    }

    public function file($file, string $fileName = null, string $disposition = ResponseHeaderBag::DISPOSITION_ATTACHMENT): BinaryFileResponse
    {
    }

    public function get(string $id, int $invalidBehavior = self::EXCEPTION_ON_INVALID_REFERENCE):?object
    {
    }

    public function has(string $id):bool
    {
    }

    public function createFormBuilder($data = null, array $options = []): FormBuilderInterface
    {
    }

    public function stream(string $view, array $parameters = [], StreamedResponse $response = null): StreamedResponse
    {
    }
}
