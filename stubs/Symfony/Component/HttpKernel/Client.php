<?php

declare(strict_types=1);

namespace Symfony\Component\HttpKernel;

if (class_exists('Symfony\Component\HttpKernel\Client')) {
    return;
}

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Client
{
    /**
     * @return Request|null A Request instance
     */
    public function getRequest()
    {
    }

    /**
     * @return Response|null A Request instance
     */
    public function getResponse()
    {
    }
}
