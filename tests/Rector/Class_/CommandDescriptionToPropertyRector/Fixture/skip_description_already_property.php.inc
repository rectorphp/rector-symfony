<?php

namespace Rector\Symfony\Tests\Rector\Class_\MakeCommandLazyRector\Fixture;

final class SkipDescriptionAlreadyProperty extends Symfony\Component\Console\Command\Command
{
    protected static $defaultName = 'some:command';
    protected static $defaultDescription = 'Description';
}
