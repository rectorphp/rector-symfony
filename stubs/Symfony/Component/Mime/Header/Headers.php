<?php

declare(strict_types=1);

namespace Symfony\Component\Mime\Header;

if (class_exists('Symfony\Component\Mime\Header\Headers')) {
    return;
}

class Headers
{
    public function get(string $name): ?HeaderInterface
    {
    }
}
