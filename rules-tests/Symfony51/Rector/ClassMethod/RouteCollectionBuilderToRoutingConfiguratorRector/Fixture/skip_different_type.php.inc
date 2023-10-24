<?php

namespace Rector\Symfony\Tests\Symfony51\Rector\ClassMethod\RouteCollectionBuilderToRoutingConfiguratorRector\Fixture;

use Symfony\Component\Routing\RouteCollectionBuilder;

final class SkipDifferentType
{
    protected function configureRoutes(RouteCollectionBuilder $routes)
    {
        $routes->add('/admin', 'App\Controller\AdminController::dashboard', 'admin_dashboard');
    }
}
