<?php

declare(strict_types=1);
final class SomeClassNoNamespaceDetailController extends \Symfony\Bundle\FrameworkBundle\Controller\Controller
{
    public function __invoke()
    {
        echo 1;
    }
}
