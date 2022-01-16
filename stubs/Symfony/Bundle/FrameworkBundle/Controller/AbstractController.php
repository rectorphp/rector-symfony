<?php

declare(strict_types=1);

namespace Symfony\Bundle\FrameworkBundle\Controller;

use Doctrine\Common\Persistence\ManagerRegistry;
use Psr\Container\ContainerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

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

    public function redirectToRoute($routeName): RedirectResponse
    {
    }

    public function get(string $id, int $invalidBehavior = self::EXCEPTION_ON_INVALID_REFERENCE)
    {
    }

    public function has(string $id)
    {
    }
}
