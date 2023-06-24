<?php

namespace Rector\Symfony\Tests\Symfony53\Rector\Class_\CommandDescriptionToPropertyRector\Fixture;

final class SkipDescriptionAlreadyProperty extends Symfony\Component\Console\Command\Command
{
    protected static $defaultName = 'some:command';
    protected static $defaultDescription = 'Description';
}
