<?php

use Symfony\Component\Routing\Router;

class CachingRouter extends Router
{
    public function getRouteCollection()
    {
        static $cache;
        if (!$cache) {
            $cache = parent::getRouteCollection();
        }

        return $cache;
    }
}

?>
-----
<?php

use Symfony\Component\Routing\Router;

class CachingRouter extends Router
{
    public function getRouteCollection(): \Symfony\Component\Routing\RouteCollection
    {
        static $cache;
        if (!$cache) {
            $cache = parent::getRouteCollection();
        }

        return $cache;
    }
}

?>
