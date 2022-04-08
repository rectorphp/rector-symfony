<?php

declare(strict_types=1);

namespace Symfony\Bundle\FrameworkBundle\Controller;

use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Response;

if (class_exists('Symfony\Bundle\FrameworkBundle\Controller\BaseController')) {
    return;
}

class BaseController
{
    public function createForm(): FormInterface
    {
        return $this->get('form.factory')->createNamed('', 'FoobarClass');
    }

    public function render($path, $params = []): Response
    {
    }

    public function redirect($url, $status = 302)
    {
    }
}
