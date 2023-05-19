<?php

declare(strict_types=1);

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

final class SomeClassNoNamespaceController extends Controller
{
    public function detailAction()
    {
        echo 1;
    }

    public function listAction()
    {
        echo 2;
    }
}
