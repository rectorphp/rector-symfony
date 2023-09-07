<?php

namespace Rector\Symfony\Tests\Symfony43\Rector\StmtsAwareInterface\TwigBundleFilesystemLoaderToTwigRector\Fixture;

final class SkipNotInstanceofFilesystemLoader
{
    public function run($class)
    {
         $classInstance = new $class();
    }
}
