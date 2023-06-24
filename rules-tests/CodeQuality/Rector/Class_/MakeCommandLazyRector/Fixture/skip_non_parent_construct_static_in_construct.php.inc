<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\MakeCommandLazyRector\Fixture;

use Symfony\Component\Console\Command\Command;

final class SkipNonParentConstructStaticInConstruct extends Command
{
    public function __construct()
    {
        Foo::init();
    }
}

?>
