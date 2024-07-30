<?php

namespace Symfony\Component\HttpFoundation;

if (class_exists('Symfony\Component\HttpFoundation\JsonResponse')) {
    return;
}

class JsonResponse extends Response
{
}
