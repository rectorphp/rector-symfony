<?php

declare(strict_types=1);

namespace Twig\Extension;

if (interface_exists('Twig\Extension\GlobalsInterface')) {
    return;
}

interface GlobalsInterface
{
}
