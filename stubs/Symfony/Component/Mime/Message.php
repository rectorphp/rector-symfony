<?php

declare(strict_types=1);

namespace Symfony\Component\Mime;

use Symfony\Component\Mime\Header\Headers;

if (class_exists('Symfony\Component\Mime\Message')) {
    return;
}

class Message
{
    public function getHeaders(): Headers
    {
    }
}
