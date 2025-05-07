<?php

namespace Symfony\Component\HttpFoundation;

if (class_exists('Symfony\Component\HttpFoundation\JsonResponse')) {
    return;
}

class JsonResponse extends Response
{
    public function __construct(array $items, int $status = 200, array $headers = [], bool $json = false)
    {
    }
}
