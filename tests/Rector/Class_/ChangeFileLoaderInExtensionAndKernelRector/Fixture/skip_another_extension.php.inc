<?php

namespace Rector\Symfony\Tests\Rector\Class_\ChangeFileLoaderInExtensionAndKernelRector\Fixture;

use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\Kernel;

final class SkipAnotherExtension extends Kernel
{
    public function registerContainerConfiguration(LoaderInterface $loader): void
    {
        $loader->load(__DIR__ . '/../../config/config.php');
    }

    public function registerBundles()
    {
    }
}
