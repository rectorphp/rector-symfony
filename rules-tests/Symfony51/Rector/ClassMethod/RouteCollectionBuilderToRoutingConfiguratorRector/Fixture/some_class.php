<?php

namespace Rector\Symfony\Tests\Symfony51\Rector\ClassMethod\RouteCollectionBuilderToRoutingConfiguratorRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Routing\RouteCollectionBuilder;

final class ConcreteMicroKernel extends Kernel
{
    use MicroKernelTrait;

    protected function configureRoutes(RouteCollectionBuilder $routes)
    {
        $routes->add('/admin', 'App\Controller\AdminController::dashboard', 'admin_dashboard');
    }

    public function registerBundles()
    {
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
    }
}

?>
