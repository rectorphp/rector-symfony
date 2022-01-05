<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\Rector\Class_\MakeCommandLazyRector\SourcePhp80;

use Symfony\Component\Console\Command\Command;

abstract class ParentClassWithPromotedPropertyCommand extends Command
{
    public function __construct(
        private string $foo
    ) {
        parent::__construct();
    }
}
