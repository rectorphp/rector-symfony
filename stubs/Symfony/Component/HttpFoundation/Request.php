<?php

declare(strict_types=1);

namespace Symfony\Component\HttpFoundation;

if (class_exists('Symfony\Component\HttpFoundation\Request')) {
    return;
}

final class Request
{
    public function getRequestType()
    {
    }

    // newer version
    public function isMainRequest()
    {
    }

    public function isMasterRequest()
    {
    }
}
