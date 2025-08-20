<?php

namespace Rector\Symfony\Tests\Set\Symfony74\Fixture;

use Symfony\Component\Routing\Attribute\Route;

class RouterSetEnvToSetEnvs
{
    public function someAction()
    {
        $route = new Route('/path');
        $route->setEnv('prod');
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Set\Symfony74\Fixture;

use Symfony\Component\Routing\Attribute\Route;

class RouterSetEnvToSetEnvs
{
    public function someAction()
    {
        $route = new Route('/path');
        $route->setEnvs('prod');
    }
}

?>
