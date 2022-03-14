<?php

declare(strict_types=1);

namespace Symfony\Bundle\FrameworkBundle;

if (class_exists('Symfony\Bundle\FrameworkBundle\Client')) {
    return;
}

final class Client extends \Symfony\Component\HttpKernel\Client
{
}
