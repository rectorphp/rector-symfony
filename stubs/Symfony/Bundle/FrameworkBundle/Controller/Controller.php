<?php

declare(strict_types=1);

namespace Symfony\Bundle\FrameworkBundle\Controller;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;

if (class_exists('Symfony\Bundle\FrameworkBundle\Controller\Controller')) {
    return;
}

abstract class Controller
{
    /**
     * @param string|AbstractType|FormInterface $formType
     */
    public function createForm($formType): FormInterface
    {
    }

    public function render(string $path, array $params = []): string
    {
    }

    public function redirect($url, $status = 302)
    {
    }
}
