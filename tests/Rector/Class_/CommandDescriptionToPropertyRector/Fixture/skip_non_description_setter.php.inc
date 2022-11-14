<?php

namespace Rector\Symfony\Tests\Rector\Class_\MakeCommandLazyRector\Fixture;

final class SkipNonDescriptionSetter extends Symfony\Component\Console\Command\Command
{
    protected static $defaultName = 'some:command';
    public function configure()
    {
    }
}
