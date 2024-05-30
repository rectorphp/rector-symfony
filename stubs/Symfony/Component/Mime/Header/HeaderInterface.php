<?php

declare(strict_types=1);

namespace Symfony\Component\Mime\Header;

if (class_exists('Symfony\Component\Mime\Header\HeaderInterface')) {
    return;
}

interface HeaderInterface
{
    public function toString(): string;
}
