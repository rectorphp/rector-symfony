<?php

use Symfony\Component\Console\Command\Command;

namespace Rector\Tests\Symfony\Symfony61\Rector\Class_\CommandConfigureToAttributeRector\Fixture;

class ExampleCommand extends Command
{
    public function __construct(private readonly string $description) {}
    
    public function configure(): void
    {
        $this->setDescription($this->description);
    }
}
?>
