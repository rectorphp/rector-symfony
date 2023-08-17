<?php
declare(strict_types=1);

namespace Symfony\Component\HttpKernel\Controller;

if (interface_exists('Symfony\Component\HttpKernel\Controller\ValueResolverInterface')) {
    return;
}

interface ValueResolverInterface
{
}
