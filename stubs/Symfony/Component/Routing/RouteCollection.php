<?php

declare(strict_types=1);

namespace Symfony\Component\Routing;

if (class_exists('Symfony\Component\Routing\RouteCollection')) {
    return;
}

class RouteCollection
{
    /**
     * @return array<string, Route>
     */
    public function all()
    {
    }
}
