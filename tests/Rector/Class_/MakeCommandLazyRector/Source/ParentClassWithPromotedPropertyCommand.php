<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\Rector\Class_\MakeCommandLazyRector\Source;

use Symfony\Component\Console\Command\Command;

abstract class ParentClassWithPromotedPropertyCommand extends Command
{
    public function __construct(
        private string $foo
    ) {
        parent::__construct();
    }
}
