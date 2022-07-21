<?php

use Symfony\Component\Routing\RouterInterface;

class CachingRouter implements RouterInterface
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

use Symfony\Component\Routing\RouterInterface;

class CachingRouter implements RouterInterface
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
